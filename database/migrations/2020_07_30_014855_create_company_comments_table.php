<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('company_id')->unsigned()->index();
            $table->BigInteger('visitor_id')->unsigned()->index();
            $table->String('comment_value');
            $table->String('comment_vote');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_comments');
    }
}
