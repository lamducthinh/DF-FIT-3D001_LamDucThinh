<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\ProductCategory;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        //Eloquent
        $keyword = $request->input('keyword');

        if ($keyword) {
            // Nếu có từ khóa tìm kiếm, thực hiện tìm kiếm
            $products = Staff::where('name', 'like', '%' . $keyword . '%')
            ->orWhere('email', 'like', '%' . $keyword . '%')
            ->get();
        } else {
            // Nếu không có từ khóa tìm kiếm, hiển thị tất cả sản phẩm
            $products = Staff::all();
        }

        // $products = Staff::with('productCategory')->withTrashed()->paginate(10);

        return view('admin.AccountOfStaff.index')->with(['products' => $products, 'keyword' => $keyword]);
    }
   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productCategories = ProductCategory::all();
        $users = User::all();
        return view('admin.pages.staff.create')->with(['productCategories' => $productCategories, 'users' => $users]);
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

        Staff::create($arrayData);
        
        return redirect()->route('admin.staff.index')->with('msg', 'Them san pham thanh cong');
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
    public function edit(Staff $product)
    {
        $productCategories = ProductCategory::all();

        return view('admin.pages.staff.detail')
        ->with('product',$product)
        ->with('productCategories', $productCategories);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $product = Staff::find($id);
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

        return redirect()->route('admin.staff.index')->with('msg', 'Cập nhật nhân viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Staff::find($id)->delete();
        return redirect()->route('admin.staff.index')->with('msg', 'Xóa nhân viên thành công');
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
        $product = Staff::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('admin.staff.index')->with('msg', 'Khôi phục dữ liệu thành công');
    }

    public function forceDelete($id){
        $product = Staff::withTrashed()->find($id);
        $product->forceDelete();
        return redirect()->route('admin.staff.index')->with('msg', 'Xóa dữ liệu thành công');
    }
}
