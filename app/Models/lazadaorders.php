<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lazadaorders extends Model
{
    use HasFactory;
    protected $fillable = ['order_number','status'];

    protected $hidden = ['created_at','updated_at'];
}
