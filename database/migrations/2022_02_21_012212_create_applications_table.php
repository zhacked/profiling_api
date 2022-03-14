<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('recruiter_id'); //fix (di ko alam saan kukunin yung recuiter id)
            $table->uuid('location_id');
            $table->binary('logo');
            $table->string('job_title');
            $table->string('company_name');
            $table->string('apply_before'); //expiration (di ko na pinaghiwalay since YYYY-MM-DD ang format)
            $table->integer('salary');  //base on post
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('recruiter_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
