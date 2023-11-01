<?php

namespace CwsDigital\TwillRedirects\Twill\Capsules\Redirects\Http\Controllers;

use A17\Twill\Http\Controllers\Admin\ModuleController as BaseModuleController;
use A17\Twill\Models\Contracts\TwillModelContract;
use A17\Twill\Services\Forms\Fields\Input;
use A17\Twill\Services\Forms\Fields\Select;
use A17\Twill\Services\Forms\Fieldset;
use A17\Twill\Services\Forms\Form;
use A17\Twill\Services\Forms\Option;
use A17\Twill\Services\Forms\Options;
use A17\Twill\Services\Listings\Columns\Text;
use A17\Twill\Services\Listings\TableColumns;

class RedirectController extends BaseModuleController
{
    protected $moduleName = 'redirects';

    /**
     * This method can be used to enable/disable defaults. See setUpController in the docs for available options.
     */
    protected function setUpController(): void
    {
        $this->disablePermalink();
        $this->setTitleColumnKey('from');
    }

    public function getCreateForm(): Form
    {
        $form = new Form();

        $form->add(
            Input::make()->name('from')->label('From')->maxLength(250)
                ->note('Please do not include the full URL. E.g. /from-url')
        );

        $form->add(
            Input::make()->name('to')->label('To')->maxLength(250)
                ->note('Please do not include the full URL. E.g. /to-url')
        );

        $form->add(
            Select::make()
                ->name('status_code')
                ->label('Status Code')
                ->default(301)
                ->options(
                    Options::make([
                        Option::make(301, '301 - Moved Permanently'),
                        Option::make(302, '302 - Temporary Redirect'),
                    ])
                )
        );

        return $form;
    }

    /**
     * See the table builder docs for more information. If you remove this method you can use the blade files.
     * When using twill:module:make you can specify --bladeForm to use a blade form instead.
     */
    public function getForm(TwillModelContract $model): Form
    {
        $form = parent::getForm($model);

        $form->addFieldset(
            Fieldset::make()->title('Redirect')->id('redirect')
                ->fields([
                    Input::make()->name('from')->label('From')->maxLength(250)
                        ->note('Please do not include the full URL. E.g. /from-url'),
                    Input::make()->name('to')->label('To')->maxLength(250)
                        ->note('Please do not include the full URL. E.g. /to-url'),
                    Select::make()
                        ->name('status_code')
                        ->label('Status Code')
                        ->default(301)
                        ->options(
                            Options::make([
                                Option::make(301, '301 - Moved Permanently'),
                                Option::make(302, '302 - Temporary Redirect'),
                            ])
                        ),
                ])
        );

        return $form;
    }

    /**
     * This is an example and can be removed if no modifications are needed to the table.
     */
    protected function additionalIndexTableColumns(): TableColumns
    {
        $table = parent::additionalIndexTableColumns();

        $table->add(
            Text::make()->field('to')->title('To')
        );

        $table->add(
            Text::make()->field('status_code')->title('Status Code')
        );

        return $table;
    }
}
