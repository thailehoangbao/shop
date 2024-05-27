<?php


namespace App\Http\Services\Menu;

use App\Models\Menu;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Str;

class MenuServices
{
    public function get($parent_id)
    {
        return Menu::where('parent_id', $parent_id)->get();
    }

    public function getList(){
        return Menu::orderByDesc('id')->paginate(5);
    }

    public function create($request) {
        try {
            // $data = $request->input();
            Menu::create([
                'name' => (string) $request->input('name'),
                'parent_id' => (int) $request->input('parent_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'slug' => Str::slug($request->input('name')),
            ]);

            FacadesSession::flash('success', 'Menu created successfully');
        } catch (\Exception $err) {

            FacadesSession::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id){
        try {
            Menu::where('id', $id)->delete();
            FacadesSession::flash('success', 'Menu deleted successfully');
            return true;
        } catch (\Exception $err) {
            FacadesSession::flash('error', $err->getMessage());
            return false;
        }
        return true;
    }

    public function update($request,$menu){
        try {
            $menu->name = $request->input('name');
            $menu->parent_id = $request->input('parent_id');
            $menu->description = $request->input('description');
            $menu->content = $request->input('content');
            $menu->active = $request->input('active');
            $menu->slug = Str::slug($request->input('name'));

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
