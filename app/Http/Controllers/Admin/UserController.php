<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

        public function indexFerch(){
            $users = User::all();      
            return view('Admin.layout.master', ['users' => $users]);
        }
        
        public function index(Request $request){
            $users = User::query();

            // Tìm kiếm theo tên người dùng
            $search = $request->input('search');
            if ($search) {
                $users->where('name', 'like', '%' . $search . '%')
                ->orWhere('email',  'like', '%' . $search . '%')
                ->orWhere('phone',  'like', '%' . $search . '%');
            }
        
            // Sắp xếp theo tên người dùng hoặc id
            $sortField = $request->input('sortField', 'name');
            $sortDirection = $request->input('sortDirection', 'asc');
            $users->orderBy($sortField, $sortDirection);
        
            $users = $users->paginate(10);
        
            return view('admin.AccountOfStaff.index', compact('users', 'search', 'sortField', 'sortDirection'));

        }
        public function detail($id) {
            
            $users = User::findOrFail($id);
    
            return view('Admin.AccountOfStaff.detail')->with('users', $users);
        }
        public function update(Request $request, $id){
          
            $users = User::find($id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'phone' => $request->phone,
                'role' => $request->role,
            ]);
    
            return redirect()->route('role.register');
        }
    
        public function destroy(Request $request, $id){
    
            $check = User::find($id)->delete();
    
            $msg = $check ? 'xoa thanh cong' : 'xoa that bai';
    
            return redirect()->route('role.register')->with('msg', $msg);
        }
    
    
    
}
