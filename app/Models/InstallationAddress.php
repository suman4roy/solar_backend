<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationAddress extends Model
{
    use HasFactory;
     protected $fillable = [
                'village',
                'landmark',
                'district',
                'pincode',
                'proposed_capacity',
                'plot_type',
    ];
}
