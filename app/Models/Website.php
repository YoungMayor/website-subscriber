<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'ulid';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'keywords' => 'array',
        ];
    }
}
