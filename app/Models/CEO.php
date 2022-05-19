<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CEO extends Model
{
    use HasFactory;

    protected $fillable= [
        'name',
        'company_name',
        'years',
        'company_headquarter',
        'what_company_does',
    ];
}
