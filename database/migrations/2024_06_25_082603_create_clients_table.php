<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
            Schema::create('clients', function (Blueprint $table) {
                $table->id();
                $table->string('firstname')->required();
                $table->string('middlename')->required();
                $table->string('lastname')->required();
                $table->datetime('dob')->required();
                $table->string('gender')->required();
                $table->string('civil_status')->required();
                $table->string('edu_att')->required();
                $table->string('religion')->required();
                $table->string('present_add')->required();
                $table->string('prov_add')->required();
                $table->integer('salary_income')->required();
                $table->string('occupation')->required();
                $table->string('nameOfBusiness')->nullable();
                $table->string('addOfBusiness')->nullable();
                $table->integer('mo_income')->nullable();
                $table->integer('contact_no')->nullable();
                $table->string('otherLoan')->nullable();
                $table->string('sp_name')->nullable();
                $table->string('sp_add')->nullable();
                $table->string('sp_occupation')->nullable();
                $table->integer('sp_salary')->nullable();
                $table->integer('no_dependents')->nullable();
                $table->integer('sp_contact')->nullable();
                $table->string('sp_children')->nullable();
                $table->longText('client_pic')->nullable();
                $table->longText('client_add_sketch')->nullable();
                $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
