<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClusteringTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clusterings', function (Blueprint $table) {
            $table->char("course_id", 200);
            $table->integer("year")->unsigned();
            $table->char("semester", 200);
            $table->double("assignment")->unsigned();
            $table->double("project")->unsigned();
            $table->double("exams")->unsigned();
            $table->double("centroid1")->unsigned();
            $table->double("centroid2")->unsigned();
            $table->double("centroid3")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clusterings', function (Blueprint $table) {
            //
        });
    }
}
