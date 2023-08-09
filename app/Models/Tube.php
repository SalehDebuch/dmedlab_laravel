<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tube extends Model
{
    use SoftDeletes;

    protected $fillable = ['tube_name', 'language_id', 'color', 'color_name', 'img'];


    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];
}
