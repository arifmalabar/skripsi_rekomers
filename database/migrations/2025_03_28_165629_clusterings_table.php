<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClusteringsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clusterings', function (Blueprint $table) {
            $table->char("student_id", 100);
            $table->double("clustering_grade")->unsigned();
            $table->enum("cluster", ["C1", "C2", "C3"]);
            $table->enum("risk", ["high", "medium", "less"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clusterings');
    }
}
