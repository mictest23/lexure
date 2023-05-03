<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'bsm-facebook',
        'bsm-instagram',
        'bsm-youtube',
        'bsm-linkedin',
    ];
}
