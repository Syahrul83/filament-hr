<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'klausul_panduan' => 'array',
        ];
    }
}
