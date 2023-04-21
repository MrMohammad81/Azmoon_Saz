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

    public function index(Request $request)
    {
        $this->validate($request , [
            'search' => 'nullable',
            'page' => 'required|numeric',
            'pagesize' => 'nullable|numeric',
        ]);

        $users = $this->userRepository->paginate($request->search ?? '', $request->page , $request->pagesize ?? 20);

        return $this->responseSuccess('کاربران', $users);
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

    public function updatePassword(Request $request)
    {
        $this->validate($request , [
            'id' => 'required',
            'password' => 'min:6|required_with:password_repeat|same:password_repeat',
            'password_repeat' => 'min:6'
        ]);

        $this->userRepository->update($request->id , [
            'password' => app('hash')->make($request->password)
        ]);

        return $this->responseSuccess('رمز عبور شما با موفقیت بروزرسانی شد' , [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }

    public function deleteUser(Request $request)
    {
        $this->validate($request , [
            'id' => 'required',
        ]);

        $this->userRepository->delete($request->id);

        return $this->responseSuccess('کاربر مورد نظر با موفقیت حذف شد' , [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ]);
    }
}
