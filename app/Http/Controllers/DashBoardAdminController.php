<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardAdminController extends Controller
{

    public function index()
    {
            $totalSeconds = Schedule::join('shifts', 'schedules.shift_id', '=', 'shifts.id')
            ->selectRaw('SUM(TIME_TO_SEC(TIMEDIFF(shifts.end_time, shifts.start_time))) AS total_hours_worked')
            ->value('total_hours_worked');

            $totalHoursWorked = $totalSeconds / 3600;

        // Lấy thông tin nhân viên làm nhiều nhất
        $mostActiveUserId = DB::table('schedules')
        ->select('users.id') // Chỉ chọn cột 'id'
        ->join('users', 'schedules.user_id', '=', 'users.id')
        ->groupBy('users.id')
        ->orderByRaw('COUNT(schedules.id) DESC')
        ->value('users.id'); // Lấy giá trị của cột 'id'

        // Lấy thông tin chi tiết của nhân viên có id là $mostActiveUserId
        $mostActiveUser = User::find($mostActiveUserId);

        // Kiểm tra xem có nhân viên nào không
        $numberOfSchedules = $mostActiveUserId ? Schedule::where('user_id', $mostActiveUserId)->count() : 0;

        $datas = Schedule::join('shifts', 'schedules.shift_id', '=', 'shifts.id')
            ->selectRaw("DATE_FORMAT(schedules.date, '%m') as month, shifts.name as shift_name, count(*) as number")
            ->groupBy('month', 'shift_name')
            ->get();

        $result = [];
        $shifts = Shift::pluck('name')->toArray(); // Lấy danh sách tên shift từ bảng shifts

        $result[] = ['Tháng', ...$shifts]; // Tên cột

        foreach ($datas as $data) {
            $row = [$data->month];
            foreach ($shifts as $shift) {
                $row[] = $data->shift_name === $shift ? $data->number : 0; // Số lượng của từng loại shift
            }
            $result[] = $row;
        }

        return view('admin.Dashboard.dashboard', [
            'result' => $result,
            'mostActiveUser' => $mostActiveUser,
            'numberOfSchedules' => $numberOfSchedules,
            'totalHoursWorked' => $totalHoursWorked
        ]);
    }
}