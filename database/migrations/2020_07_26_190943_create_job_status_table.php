<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('job_id');
            $table->string('accepted')->nullable();
            $table->string('rejected')->nullable();
            $table->string('assigned')->nullable();
            $table->string('in_progress')->nullable();
            $table->string('done')->nullable();
            $table->dateTime('accepted_at')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->dateTime('assigned_at')->nullable();
            $table->dateTime('in_progress_at')->nullable();
            $table->dateTime('done_at')->nullable();

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
        Schema::dropIfExists('job_statuses');
    }
}
