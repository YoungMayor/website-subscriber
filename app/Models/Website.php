<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscribedUsers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'website_subscriptions',
            'website_ulid',
            'user_ulid',
        )->using(WebsiteSubscription::class);
    }

    public function isSubscribedTo(User $user): bool
    {
        return $this->subscribedUsers()->where('user_ulid', $user->ulid)->exists();
    }
}
