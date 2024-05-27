<?php


namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuServices
{
    public function get($parent_id)
    {
        return Menu::where('parent_id', $parent_id)->get();
    }

    public function getList()
    {
        return Menu::orderByDesc('id')->paginate(5);
    }

    public function create($request)
    {
        try {
            // Handle the file upload
            if ($request->hasFile('thumb')) {
                $file = $request->file('thumb');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public'); // stores file in storage/app/public/uploads
            }

            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name')),
                'thumb' => (string) $fileName,
            ]);

            FacadesSession::flash('success', 'Menu created successfully');
        } catch (\Exception $err) {

            FacadesSession::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        try {
            $menu = Menu::findOrFail($id);

            // Get the file path
            $filePath = 'uploads/' . $menu->thumb;


            // Delete the file if it exists
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            $menu->delete();

            FacadesSession::flash('success', 'Menu deleted successfully');
            return true;
        } catch (\Exception $err) {
            FacadesSession::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request, $menu)
    {
        // Check if the request has a new file and handle the file upload
        if ($request->hasFile('thumb')) {
            // Get the existing file path
            $oldFilePath = 'uploads/' . $menu->thumb;

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
            $fileName = $menu->thumb;
        }

        try {
            $menu->name = $request->input('name');
            $menu->parent_id = $request->input('parent_id');
            $menu->description = $request->input('description');
            $menu->content = $request->input('content');
            $menu->active = $request->input('active');
            $menu->slug = Str::slug($request->input('name'));
            $menu->thumb = $fileName;

            $menu->save();
            FacadesSession::flash('success', 'Menu updated successfully');
            return true;
        } catch (\Exception $err) {
            FacadesSession::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }
}
