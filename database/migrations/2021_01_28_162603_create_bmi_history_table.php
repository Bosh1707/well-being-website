<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmiHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bmi_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('weight',5,2);
            $table->decimal('height',5,2);
            $table->decimal('bmi',5,2);
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bmi_history');
    }
}
