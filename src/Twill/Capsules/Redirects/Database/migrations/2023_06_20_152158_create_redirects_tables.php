<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRedirectsTables extends Migration
{
    public function up()
    {
        if (! Schema::hasTable('redirects')) {
            Schema::create('redirects', function (Blueprint $table) {
                // this will create an id, a "published" column, and soft delete and timestamps columns
                createDefaultTableFields($table);

                $table->string('from')->index()->nullable();
                $table->string('to')->index()->nullable();
                $table->integer('status_code')->default(301);

            });
        }

    }

    public function down()
    {
        Schema::dropIfExists('redirects');
    }
}
