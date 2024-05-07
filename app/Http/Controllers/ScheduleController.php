<?php

namespace App\Http\Controllers;

use App\Models\CheckIn;
use App\Models\CheckOut;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Shift;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class ScheduleController extends Controller
{
    public function indexPagination(Request $request)
    {
        $itemPerPage = 3;
        $totalItems = DB::table('schedules')->count();
        $totalPage = ceil($totalItems / $itemPerPage);
        $page = $request->page ?? 1;

        $index = ($page - 1) * $itemPerPage;

        $schedules = DB::table('schedules')
            ->offset($index)
            ->limit($itemPerPage)
            ->get();

        return view('admin.shifts.index', [
            'schedules' => $schedules,
            'totalPage' => $totalPage,
            'itemPerPage' => $itemPerPage,
            'page' => $page
        ]);
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userId = auth()->user()->id;

        if (auth()->user()->role == 1) {
            $query = Schedule::with(['user', 'shift'])->withTrashed();
        } else {
            $query = Schedule::where('user_id', $userId)->with(['user', 'shift'])->withTrashed();
        }

        if ($search) {
            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('date', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->input('sort'), $request->input('order'));
        }

        $schedules = $query->paginate(env('PAGINATION_ITEM', 10));

        return view('admin.shifts.index', compact('schedules'));
    }

   

    
    public function checkIn(Request $request)
    {
        // Lấy thông tin schedule_id từ yêu cầu POST
        $scheduleId = $request->input('schedule_id');
    
        // Lưu thông tin Check-in vào cơ sở dữ liệu
        CheckIn::create([
            'user_id' => $request->user()->id,
            'schedule_id' => $scheduleId,
            'check_in_time' => now(),
           
        ]);
    
        // Trả về thông báo cho người dùng
        return redirect()->back()->with('success', 'Check-in thành công.');
    }
    public function checkOut(Request $request)
    {
        // Lấy thông tin schedule_id từ yêu cầu POST
        $scheduleId = $request->input('schedule_id');
    
        // Lưu thông tin Check-in vào cơ sở dữ liệu
        CheckOut::create([
            'user_id' => $request->user()->id,
            'schedule_id' => $scheduleId,
            'check_out_time' => now(),
           
        ]);
    
        // Trả về thông báo cho người dùng
        return redirect()->back()->with('success', 'Check-out thành công.');
    }
  

    public function create(Request $request)
    {
    $search = $request->input('search');

    $query = User::withTrashed(); // Optional: Include trashed users in search

    if ($search) {
        $query->whereHas('user', function ($userQuery) use ($search) {
        $userQuery->where('name', 'like', '%' . $search . '%');
        });
    }

    $users = $query->get(); 

    $shifts = Shift::all();


    $schedule = new Schedule();

    return view('admin.shifts.create', compact('search', 'users', 'shifts', 'schedule'));
    }

    public function store(Request $request)
    {
        
        $twoMonthsLater = now()->addMonths(2)->format('Y-m-d');

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shift_id' => 'required|exists:shifts,id',
            'date' => [
                'required',
                'date',
                'after_or_equal:' . now()->format('Y-m-d'), // Thời gian không được là thời gian ở quá khứ
                'before:' . $twoMonthsLater, // Thời gian không được vượt quá 2 tháng
            ],
            
        ], [
            'user_id.required' => 'Phải chọn nhân viên!',
            'shift_id.required' => 'Phải chọn ca làm!',
            'date.after_or_equal' => 'Thời gian không được là thời gian ở quá khứ.',

        ]);

        Schedule::create($data);

        return redirect()->route('shifts.index')->with('success', 'Lịch làm việc đã được tạo thành công.');
    }

    public function edit($id)
    {
        $schedule = Schedule::find($id);
        $users = User::all();
        $shifts = Shift::all();

        return view('admin.shifts.edit', compact('schedule', 'users', 'shifts'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'shift_id' => 'required',
            'date' => 'required|date',
        ]);

        $schedule = Schedule::find($id);
        $schedule->user_id = $request->input('user_id');
        $schedule->shift_id = $request->input('shift_id');
        $schedule->date = $request->input('date');
        $schedule->save();

        return redirect()->route('shifts.index')->with('success', 'Lịch làm việc đã được cập nhật thành công.');
    }


    public function destroy($id)
    {
        Schedule::destroy($id);
        return redirect()->route('shifts.index')->with('success', 'Lịch làm việc đã được xóa thành công.');
    }
  


    public function restore($id){
        $product = Schedule::withTrashed()->find($id);
        $product->restore();
        return redirect()->route('shifts.index')->with('success', 'Khôi phục dữ liệu thành công');
    }

    public function forceDelete($id){
        $product = Schedule::withTrashed()->find($id);
        $product->forceDelete();
        return redirect()->route('shifts.index')->with('success', 'Xóa dữ liệu thành công');
    }
  
        
    // public function checkInPagination(Request $request)
    // {
    //     $itemPerPage = 10; // Số mục trên mỗi trang
    //     $totalItems = CheckIn::count(); // Đếm tổng số check-in
    //     $totalPage = ceil($totalItems / $itemPerPage); // Tính tổng số trang
    //     $page = $request->page ?? 1; // Trang hiện tại, mặc định là trang 1 nếu không có trang được chỉ định

    //     $index = ($page - 1) * $itemPerPage; // Tính chỉ mục bắt đầu của các mục cho trang hiện tại

    //     // Lấy danh sách check-in phân trang
    //     $checkIns = CheckIn::offset($index)
    //         ->limit($itemPerPage)
    //         ->get();

    //     return view('admin.checkins.index', [
    //         'checkIns' => $checkIns,
    //         'totalPage' => $totalPage,
    //         'itemPerPage' => $itemPerPage,
    //         'page' => $page
    //     ]);
    // }

    // public function checkOutPagination(Request $request)
    // {
    //     $itemPerPage = 10; // Số mục trên mỗi trang
    //     $totalItems = CheckOut::count(); // Đếm tổng số check-out
    //     $totalPage = ceil($totalItems / $itemPerPage); // Tính tổng số trang
    //     $page = $request->page ?? 1; // Trang hiện tại, mặc định là trang 1 nếu không có trang được chỉ định

    //     $index = ($page - 1) * $itemPerPage; // Tính chỉ mục bắt đầu của các mục cho trang hiện tại

    //     // Lấy danh sách check-out phân trang
    //     $checkOuts = CheckOut::offset($index)
    //         ->limit($itemPerPage)
    //         ->get();

    //     return view('admin.checkouts.index', [
    //         'checkOuts' => $checkOuts,
    //         'totalPage' => $totalPage,
    //         'itemPerPage' => $itemPerPage,
    //         'page' => $page
    //     ]);
    // }



}