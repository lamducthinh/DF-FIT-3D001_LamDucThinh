<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    //shiftScheduling
    public function shiftScheduling(){
        return view('admin.form.shiftScheduling');
    }
    public function shiftList(){
        return view('admin.form.shift-list');
    }
}
