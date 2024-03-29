<?php

namespace App\Http\Controllers\API;

use App\Actions\Website\Subscriber;
use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function subscribe(
        Request $request,
        Website $website,
        Subscriber $subscriber
    ) {
        if ($website->isSubscribedTo($request->user())) {
            return apiResponse(StatusCode::BAD_REQUEST, 'app.website.already_subscribed');
        }

        $subscriber($request->user(), $website);

        return apiResponse(StatusCode::CREATED, 'app.website.subscribed');
    }
}
