<?php

namespace App\Http\Controllers\API\V1\Users;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function store()
    {
        return response()->json([
            'success' => true,
            'massage' => 'کاربر با موفقیت ایجاد شد',
            'data' => [
                'full_name' => 'Mohammad',
                'email' => 'mohammad@gmail.com',
                'mobile' => '0930655622',
                'password' => '123456'
            ]
        ])->setStatusCode(201);
    }
}
