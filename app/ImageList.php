<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageList extends Model
{
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [        
        'image',
        'caption',
        'description',
        'created_by',        
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
