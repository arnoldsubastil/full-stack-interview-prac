<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodTag extends Model
{
    
    protected $table = 'prod_tags';
    public $timestamps = true;

    protected $fillable = [
        'tag_id',
        'prod_id',
    ];
}
