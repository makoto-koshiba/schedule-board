<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCulumToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
             $table->string('code');
             $table->string('address');
             $table->string('client');
             $table->string('personnel');
             $table->string('countact');
             $table->string('leader');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('address');
            $table->dropColumn('client');
            $table->dropColumn('personnel');
            $table->dropColumn('countact');
            $table->dropColumn('leadesr');
        });
    }
}
