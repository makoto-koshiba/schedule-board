<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProjectsTableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
             $table->string('address')->nullable()->change();
             $table->string('personnel')->nullable()->change();
             $table->string('countact')->nullable()->change();
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
             $table->string('address')->nullable(false)->change();
             $table->string('personnel')->nullable(false)->change();
             $table->string('countact')->nullable(false)->change();
        });
    }
}
