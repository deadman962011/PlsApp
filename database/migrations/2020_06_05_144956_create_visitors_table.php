<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vis_name',200);
            $table->string('vis_last_name',200);
            $table->integer('vis_phone')->default(0);
            $table->string('vis_city');
            $table->string('vis_address',200);
            $table->String('vis_password');
            $table->String('role');
            $table->String('email');
            $table->String('vis_username');
            $table->String('vis_status');
            
            $table->String('vis_restpass_token');
            $table->String('vis_activation_token');
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
        Schema::dropIfExists('visitors');
    }
}
