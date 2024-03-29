<?php

namespace App\Http\Controllers\API;

use App\Enums\StatusCode;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(Request $request)
    {
        return apiResponse(
            StatusCode::OK,
            'app.action.success',
            (new UserResource($request->user()))->resolve()
        );
    }
}
