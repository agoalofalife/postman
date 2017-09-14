<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSheduleEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedule_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date');
            $table->integer('email_id')->unsigned();
            $table->foreign('email_id')->references('id')->on('emails');
            $table->integer('mode_id')->unsigned();
            $table->foreign('mode_id')->references('id')->on('mode_post_emails');
            $table->boolean('status_action')->comment('status post email');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shedule_emails');
    }
}
