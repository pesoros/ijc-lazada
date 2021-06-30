<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LazadaDetail extends Model
{
    protected $fillable = ['id_product','id_lazada'];

    protected $hidden = ['created_at','updated_at'];
}
