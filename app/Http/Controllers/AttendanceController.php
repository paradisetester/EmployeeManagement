<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $today = Carbon::today();
        
        $todayAttendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();
        
        $recentAttendances = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();
        
        return view('employee.attendance', compact('todayAttendance', 'recentAttendances'));
    }
    
    public function checkIn(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today();
        $now = Carbon::now();
        
        $attendance = Attendance::firstOrCreate(
            [
                'user_id' => $user->id,
                'date' => $today
            ],
            [
                'check_in' => $now->format('H:i'),
                'status' => $now->format('H:i') > '09:00' ? 'late' : 'present'
            ]
        );
        
        if ($attendance->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Checked in successfully!');
        }
        
        return redirect()->back()->with('error', 'You have already checked in today.');
    }
    
    public function checkOut(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today();
        $now = Carbon::now();
        
        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $today)
            ->first();
        
        if (!$attendance) {
            return redirect()->back()->with('error', 'Please check in first.');
        }
        
        if ($attendance->check_out) {
            return redirect()->back()->with('error', 'You have already checked out today.');
        }
        
        $attendance->update([
            'check_out' => $now->format('H:i')
        ]);
        
        return redirect()->back()->with('success', 'Checked out successfully!');
    }
    
    public function adminIndex(Request $request)
    {
        $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        $month = $request->get('month', Carbon::today()->format('Y-m'));
        $view = $request->get('view', 'daily');
        
        if ($view === 'monthly') {
            $employees = User::where('role', 'employee')->get();
            $monthStart = Carbon::parse($month . '-01');
            $monthEnd = $monthStart->copy()->endOfMonth();
            
            $attendances = Attendance::whereBetween('date', [$monthStart, $monthEnd])
                ->with('user')
                ->get()
                ->groupBy('user_id');
                
            return view('admin.attendance', compact('employees', 'attendances', 'month', 'view', 'monthStart', 'monthEnd'));
        }
        
        $employees = User::where('role', 'employee')
            ->with(['attendances' => function($query) use ($date) {
                $query->where('date', $date);
            }])
            ->get();
            
        return view('admin.attendance', compact('employees', 'date', 'view'));
    }
}
