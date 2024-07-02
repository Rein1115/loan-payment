<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'loanStatus',
        'loanType',
        'loanPurpose',
        'loanAmount',
        'period_days',
        'term',
        'interest_per_month',
        'interest_amount',
        'clientId',
        'total_amount',
        'co_maker',
        'checkedBy',
        'approvedBy',
    ];
}
