<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lazada extends Model
{
    protected $fillable = ['nama','sku_lazada','akun'];

    protected $hidden = ['created_at','updated_at'];
}
