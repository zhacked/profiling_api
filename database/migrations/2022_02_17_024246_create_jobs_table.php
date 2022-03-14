<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('industry_id');
            $table->uuid('department_id');
            $table->uuid('job_level_id');
            $table->uuid('job_type_id');
            $table->uuid('education_id');
            $table->string('job_title');
            $table->string('contract');
            $table->string('description');
            $table->string('minimum_requirements');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->string('location');
            $table->text('perks_benefits');
            $table->integer('no_of_vacancy');
            $table->string('header_image');
            $table->string('featured_image');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('industry_id')->references('id')->on('industries')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('job_level_id')->references('id')->on('job_levels')->onDelete('cascade');
            $table->foreign('job_type_id')->references('id')->on('job_types')->onDelete('cascade');
            $table->foreign('education_id')->references('id')->on('educations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
