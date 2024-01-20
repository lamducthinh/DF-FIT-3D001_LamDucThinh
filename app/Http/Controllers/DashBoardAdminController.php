<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardAdminController extends Controller
{

    public function index()
    {
        $datas = Schedule::join('shifts', 'schedules.shift_id', '=', 'shifts.id')
            ->selectRaw("DATE_FORMAT(schedules.date, '%m') as month, shifts.name as shift_name, count(*) as number")
            ->groupBy('month', 'shift_name')
            ->get();
    
        $result = [];
        $shifts = Shift::pluck('name')->toArray(); // Lấy danh sách tên shift từ bảng shifts
    
        $result[] = ['Số tháng nhân viên làm', ...$shifts]; // Tên cột
    
        foreach ($datas as $data) {
            $row = [$data->month];
            foreach ($shifts as $shift) {
                $row[] = $data->shift_name === $shift ? $data->number : 0; // Số lượng của từng loại shift
            }
            $result[] = $row;
        }
    
        return view('admin.Dashboard.dashboard')->with('result', $result);
    }
}