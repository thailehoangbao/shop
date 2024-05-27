<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SliderServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function store($request)
    {
        // Handle the file upload
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public'); // stores file in storage/app/public/uploads
        }

        try {
            Slider::create([
                'name' => (string) $request->input('name'),
                'url' => (string) $request->input('url'),
                'thumb' => (string) $fileName,
                'active' => (string) $request->input('active'),
                'sort_by' => (int) $request->input('sort_by'),
            ]);
            Session::flash('success', 'Slider created successfully');
        } catch (\Exception $err) {

            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function getAll()
    {
        return Slider::orderByDesc('id')->paginate(5);;
    }

    public function delete($id)
    {
        try {
            // Retrieve the slider record
            $slider = Slider::findOrFail($id);

            // Get the file path
            $filePath = 'uploads/' . $slider->thumb;

            // Delete the file if it exists
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Delete the slider record from the database
            $slider->delete();

            Session::flash('success', 'Slider deleted successfully');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }


    public function update($request, $slider)
    {
        // Check if the request has a new file and handle the file upload
        if ($request->hasFile('thumb')) {
            // Get the existing file path
            $oldFilePath = 'uploads/' . $slider->thumb;

            // Delete the old file if it exists
            if (Storage::disk('public')->exists($oldFilePath)) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Store the new file
            $file = $request->file('thumb');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');
        } else {
            // If no new file, retain the old file name
            $fileName = $slider->thumb;
        }

        try {
            $slider->update([
                'name' => (string) $request->input('name'),
                'url' => (string) $request->input('url'),
                'thumb' => (string) $fileName,
                'active' => (string) $request->input('active'),
                'sort_by' => (int) $request->input('sort_by'),
            ]);
            Session::flash('success', 'Slider updated successfully');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }
}
