<?php

namespace App\Http\Controllers\Client\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\CreateFormRequest;
use App\Http\Services\Profile\ProfileServices;


class ProfileController extends Controller
{
    protected $profileRepository;
    public function __construct(ProfileServices $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function index()
    {
        return view('client.profile.profile');
    }

    public function update(CreateFormRequest $request)
    {
        $result = $this->profileRepository->update($request);
        if($result) {
            return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
        }
        return redirect()->back()->with('error', 'Cập nhật thông tin thất bại');
    }
}
