<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
   
    public function index()
    {
        //Eloquent
        $products = Product::with('productCategory')->withTrashed()->paginate(10);

        return view('admin.pages.product.index')->with('products', $products);

    }
    public function userProfile($userId)
{
    // Eloquent
    $user = Product::with('productCategory')->withTrashed()->find($userId);

    return view('admin.UsersProfile.index', compact('user'));
}
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        
        return view('admin.pages.product.create')->with('productCategories', $productCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $fileName = $this->storeImage($request);
        //Mass Assigment
        $arrayData = $request->except('_token', 'image_url');
        $arrayData['image_url'] = $fileName;

        Product::create($arrayData);
        
        return redirect()->route('admin.product.index')->with('msg', 'Them san pham thanh cong');
    }
    
    private function storeImage(Request $request): ?string{
        $fileName = null;
        if ($request->hasFile('image_url')) {
            $originName = $request->file('image_url')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);

            $extension = $request->file('image_url')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('image_url')->move(public_path('images'), $fileName);
        }
        return $fileName;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $productCategories = ProductCategory::all();

        return view('admin.pages.product.detail')
        ->with('product',$product)
        ->with('productCategories', $productCategories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $product = Product::find($id);
        // $product->name = $request->name;
        // $product->save();
        $oldImage = $product->image_url;
        
        $arrayData = $request->except('_token', '_method','image_url');
        $fileName = $this->storeImage($request);
        if(!is_null($fileName)){
            $arrayData['image_url'] = $fileName;
            if(!is_null($oldImage)){
                unlink(public_path('images')."/".$oldImage);
            }
        }
    
        $product->update($arrayData);

        return redirect()->route('admin.product.index')->with('msg', 'Cập nhật nhân viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return redirect()->route('admin.product.index')->with('msg', 'Xóa nhân viên thành công');
    }

    public function uploadImage(Request $request){
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $url = asset('images/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function restore($id){
        $product = Product::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('admin.product.index')->with('msg', 'Khôi phục dữ liệu thành công');
    }

    public function forceDelete($id){
        $product = Product::withTrashed()->find($id);
        $product->forceDelete();
        return redirect()->route('admin.product.index')->with('msg', 'Xóa dữ liệu thành công');
    }
}