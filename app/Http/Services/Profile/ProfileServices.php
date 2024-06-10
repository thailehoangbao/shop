<?php

namespace App\Http\Services\Profile;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileServices
{
    public function update($request)
    {

        $user = User::find(auth()->id());

        // Check if the request has a new file and handle the file upload
        if ($request->hasFile('avatar')) {
            // Get the existing file path
            $oldFilePath = 'uploads/' . $user->avatar;

            // Delete the old file if it exists
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Store the new file
            $file = $request->file('avatar');
            $fileName = time() . '_avatar_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

        } else {
            $fileName = $user->avatar;
        }

        try {
            $user->update([
                'name' => (string) $request->input('name'),
                'location' => (string) $request->input('location'),
                'phone_number' => (int) $request->input('phone_number'),
                'avatar' => (string) $fileName,
            ]);

            return true;
        } catch (\Exception $err) {

            return false;
        }

        return true;
    }

    public function getListsPayments($id)
    {
        return Payment::where('user_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::find($id);

            if ($payment->status == 0) {
                $payment->delete();
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
}
