<?php

namespace App\Http\Controllers\API\V1\Users;

use App\Http\Controllers\API\V1\Contracts\APIController;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UsersController extends APIController
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        $this->userRepository->create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => app('hash')->make($request->password)
        ]);

        return $this->responseCreated('کاربر با موفقیت ایجاد شد' , [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $request->password
        ]);
    }

    public function updateInfo(Request $request)
    {
        $this->validate($request , [
            'id' => 'required',
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email',
            'mobile' => 'required'
        ]);

        $this->userRepository->update($request->id , [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);

        return $this->responseSuccess('کاربر با موفقیت بروزرسانی شد' , [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }
}
