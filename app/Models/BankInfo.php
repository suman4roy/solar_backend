<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory;

     protected $fillable = [
                'finance_type',
                'bank_name',
                'account_no',
                'ifsc_code',
                'account_holder',
                'branch',
    ];
}
