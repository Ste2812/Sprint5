<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gameDices(){

        $dice_one = rand(1,6);
        $dice_two = rand(1,6);
        $result= $dice_one + $dice_two;

        return $result;
    }


    public function getPorcentajeExitoAttribute()
    {
        return $this->points / $this->dice_one * 100;
    }

    public function getResultAttribute()
    {
        if ($this->points == 7) {
            return 'won!';
        } else {
            return 'lost! try again';
        }
    }


}
