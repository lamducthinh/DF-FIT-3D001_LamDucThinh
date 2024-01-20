<?php

namespace App\Http\Controllers;

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
        
        $query = Schedule::withTrashed();

        if ($search) {
            $query->whereHas('user', function ($userQuery) use ($search) {
                $userQuery->where('name', 'like', '%' . $search . '%')
                ->orwhere('date', 'like', '%' . $search . '%');
            });
        }

        if ($request->has('sort') && $request->has('order')) {
            $query->orderBy($request->input('sort'), $request->input('order'));
        }

        $schedules = $query->paginate(env('PAGINATION_ITEM', 10));

        return view('admin.shifts.index', compact('schedules'));
    }

    public function create(Request $request)
    {      
        $users = User::all();
        $shifts = Shift::all();
        return view('admin.shifts.create', compact('users', 'shifts'));
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
}