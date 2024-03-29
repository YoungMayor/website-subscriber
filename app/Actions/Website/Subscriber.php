<?php

namespace App\Actions\Website;

use App\Models\User;
use App\Models\Website;
use App\Notifications\Website\SubscribedToWebsiteSuccessful;

class Subscriber
{
    public function __invoke(User $user, Website $website)
    {
        $user->subscribedWebsites()->attach($website->ulid, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->notifyUserOfSubscription($user, $website);
    }

    private function notifyUserOfSubscription(User $user, Website $website)
    {
        $user->notify(new SubscribedToWebsiteSuccessful($website));
    }
}
