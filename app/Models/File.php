<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        'file-name',
        'file-extension',
        'file-path'
    ];
}
