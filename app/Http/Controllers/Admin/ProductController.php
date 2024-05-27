<?php
// php artisan make:controller Admin\ProductController --resourc
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateFormRequest;
use App\Http\Services\Product\ProductServices;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productServices;

    public function __construct(ProductServices $productServices)
    {
        $this->productServices = $productServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.product.list',[
            'title' => 'Danh Sách Danh Mục',
            'products' => $this->productServices->getList()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $menusParent = $this->productServices->getMenu(0);
        // $menusChild = $this->productServices->getAllSubMenus();
        // return view('admin.product.add',[
        //     'title' => 'Thêm sản phẩm',
        //     'menusParent' => $menusParent,
        //     'menusChild' => $menusChild
        // ]);
        $menus = $this->productServices->getAllSubMenus();
        return view('admin.product.add',[
            'title' => 'Thêm sản phẩm',
            'menus' => $menus
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFormRequest $request)
    {
        $result = $this->productServices->create($request);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.product.edit',[
            'title' => 'Chỉnh Sửa Sản Phẩm '.$product->name,
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateFormRequest $request, Product $product)
    {
        $result = $this->productServices->update($request,$product);
        if($result){
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result = $this->productServices->delete($request->id);
        if($result){
            return redirect()->back();
        }
    }
}
