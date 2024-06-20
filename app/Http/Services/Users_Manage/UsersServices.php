<?php

namespace App\Http\Services\Users_Manage;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UsersServices
{
    public function __construct()
    {
    }

    public function store($request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['role_id'] = $request->role_id;
        $data['status'] = $request->status;
        $result = User::create($data);
        return $result;
    }

    public function getAll()
    {
        $result = User::orderBy('created_at', 'desc')->paginate(10);
        return $result;
    }

    public function destroy($id)
    {
        $result = User::findOrFail($id)->delete();
        return $result;
    }

    public function edit($user)
    {
        $result = User::findOrFail($user);
        return $result;
    }


    public function update($request)
    {
        // Check if the request has a new file and handle the file upload
        if ($request->hasFile('avatar')) {
            // Get the existing file path
            $oldFilePath = 'uploads/' . $request->avatar;

            // Delete the old file if it exists
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Store the new file
            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        } else {
            // If no new file, retain the old file name
            $fileName = $request->avatar;
        }
        try {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->location = $request->location;
            $user->phone_number = $request->phone_number;
            $user->role_id = $request->role_id;
            $user->status = $request->status;
            $user->avatar = $fileName;
            $user->save();

            Session::flash('success', 'user updated successfully');
        } catch (\Exception $err) {

            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
}
