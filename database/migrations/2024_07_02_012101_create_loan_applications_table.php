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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->string('loanStatus');
            $table->string('loanType');
            $table->string('loanPurpose');
            $table->string('loanAmount');
            $table->string('period_days');
            $table->string('term');
            $table->decimal('interest_per_month', 8, 2);
            $table->decimal('interest_amount', 8, 2);
            $table->unsignedBigInteger('clientId');
            $table->decimal('total_amount', 8, 2);
            $table->decimal('daily_dues', 8, 2);
            $table->string('co_maker');
            $table->string('checkedBy');
            $table->string('approvedBy');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
