<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
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

    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn () => str($this->website->url)->finish('/')->append($this->slug),
        );
    }
}
