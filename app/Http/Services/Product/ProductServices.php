<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductServices
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getMenu($parent_id)
    {
        if ($parent_id > 0) {
            return Menu::where('parent_id', $parent_id)->get();
        }
        return Menu::where('parent_id', 0)->get();
    }

    public function getAllSubMenus()
    {
        return Menu::where('parent_id', '>', 0)->get();
    }

    public function getMenus()
    {
        return Menu::all();
    }

    public function create($request)
    {
       // Handle the file upload
        if ($request->hasFile('thumb')) {
        $file = $request->file('thumb');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $fileName, 'public'); // stores file in storage/app/public/uploads
        }

        try {
            Product::create([
                'name' => (string) $request->input('name'),
                'menu_id' => (int) $request->input('menu_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'thumb' => (string) $fileName,
                'price' => (int) $request->input('price'),
                'price_sale' => (int) $request->input('price_sale'),
            ]);

            Session::flash('success', 'Product created successfully');
        } catch (\Exception $err) {

            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function getList()
    {
        return Product::with('menu')->orderByDesc('id')->paginate(5);
    }

    public function getDetail($id)
    {
        return Product::find($id);
    }

    public function update($request, $product)
    {
        if ($request->hasFile('thumb')) {
            $file = $request->file('thumb');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public'); // stores file in storage/app/public/uploads
        }
        try {
            $product->update([
                'name' => (string) $request->input('name'),
                'menu_id' => (int) $request->input('menu_id'),
                'description' => (string) $request->input('description'),
                'content' => (string) $request->input('content'),
                'active' => (string) $request->input('active'),
                'price' => (int) $request->input('price'),
                'price_sale' => (int) $request->input('price_sale'),
                'thumb' => (string) $fileName,
            ]);

            Session::flash('success', 'Product updated successfully');
        } catch (\Exception $err) {

            Session::flash('error', $err->getMessage());
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            Session::flash('success', 'Product deleted successfully');
            return true;
        }
        Session::flash('error', 'Product not found');
        return false;
    }
}


// <div class="form-group">
// <label for="danhmuc">Danh Mục Tổng Menu</label>
// <select class="form-control" name="menu_id">
//     <option value="0">Danh mục Tổng Menu</option>
//     @foreach($menusParent as $menu)
//     <option value="{{$menu->id}}">{{$menu->name}}</option>
//     @endforeach
// </select>
// @error('menu_id')
// <div class="alert alert-danger">{{ $message }}</div>
// @enderror
// </div>

// <div class="form-group">
// <label for="danhmuc">Danh Mục Group Menu</label>
// <select class="form-control" name="menu_id">
//     <option value="0">Danh mục Group Menu</option>
//     @foreach($menusChild as $menu)
//     <option value="{{$menu->id}}">{{$menu->name}}</option>
//     @endforeach
// </select>
// @error('menu_id')
// <div class="alert alert-danger">{{ $message }}</div>
// @enderror
// </div>

