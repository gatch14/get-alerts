<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    protected $table = 'cryptos';

    protected $fillable = ['name', 'price', 'choices', 'choices_value', 'alerted', 'user_id'];
}
