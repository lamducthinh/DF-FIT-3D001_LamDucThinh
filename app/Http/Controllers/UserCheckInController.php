<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use App\Models\User;
use Illuminate\Http\Request;

class UserCheckInController extends Controller
{
    public function checkinList(Request $request)
    {
        // Lấy danh sách check-in
        $checkIns = CheckIn::query();

        // Thêm điều kiện tìm kiếm theo tên nhân viên nếu có
        if ($request->has('name')) {
            $checkIns->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        // Sắp xếp theo thời gian Check-in nếu có yêu cầu sắp xếp
        if ($request->has('sort')) {
            if ($request->input('sort') === 'latest') {
                $checkIns->orderBy('check_in_time', 'desc');
            } elseif ($request->input('sort') === 'oldest') {
                $checkIns->orderBy('check_in_time', 'asc');
            }
        }

        // Lấy danh sách check-in sau khi áp dụng các điều kiện và sắp xếp
        $checkIns = $checkIns->get();

        // Trả về view 'admin.shifts.checkIn' và truyền biến $checkIns vào view
        return view('admin.shifts.checkIn', ['checkIns' => $checkIns]);
    }
    public function checkOutList(Request $request)
    {
        // Lấy danh sách check-in
        $checkOuts = CheckOut::query();

        // Thêm điều kiện tìm kiếm theo tên nhân viên nếu có
        if ($request->has('name')) {
            $checkOuts->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            });
        }

        // Sắp xếp theo thời gian Check-in nếu có yêu cầu sắp xếp
        if ($request->has('sort')) {
            if ($request->input('sort') === 'latest') {
                $checkOuts->orderBy('check_out_time', 'desc');
            } elseif ($request->input('sort') === 'oldest') {
                $checkOuts->orderBy('check_out_time', 'asc');
            }
        }

        // Lấy danh sách check-in sau khi áp dụng các điều kiện và sắp xếp
        $checkOuts = $checkOuts->get();

        // Trả về view 'admin.shifts.checkIn' và truyền biến $checkIns vào view
        return view('admin.shifts.checkOut', ['checkOuts' => $checkOuts]);
    }
    
}
