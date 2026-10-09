<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Technician;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
     //DASHBOARD
  
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalAdmins = User::where('role_id', 2)->count();
        $totalTechnicians = Technician::count();
        $totalOrders = Order::count();

        // 🔥 LAPORAN BULANAN (UNTUK DASHBOARD)
        $laporan = Order::select(
                DB::raw("COUNT(id) as total"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan")
            )
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('bulan', 'desc')
            ->limit(5)
            ->get();

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalTechnicians',
            'totalOrders',
            'laporan'
        ));
    }

     //TECHNICIANS PAGE
  
    public function technicians()
    {
        return view('superadmin.technicians');
    }

     //ADMIN MANAGEMENT
   
    public function adminsIndex()
    {
        $admins = User::where('role_id', 2)
            ->latest()
            ->get();

        return view('superadmin.admins.index', compact('admins'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 2,
            'status'   => 'aktif',
        ]);

        return back()->with('success', 'Admin berhasil ditambahkan');
    }

    public function editAdmin($id)
    {
        $admin = User::where('role_id', 2)->findOrFail($id);

        return view('superadmin.admins.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::where('role_id', 2)->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $admin->id,
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'status'  => $request->status,
            'role_id' => $request->role_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()
            ->route('superadmin.admins.index')
            ->with('success', 'Admin berhasil diupdate');
    }

    public function destroyAdmin($id)
    {
        $admin = User::where('role_id', 2)->findOrFail($id);
        $admin->delete();

        return back()->with('success', 'Admin berhasil dihapus');
    }

    //SERVICES
   
    public function services()
    {
        return view('superadmin.services');
    }


     //TRANSACTIONS

    public function transactions()
    {
        $orders = Order::with(['user', 'technician', 'service', 'status'])
            ->latest()
            ->get();

        $completed = Order::where('status_id', 3)->count();
        $pending = Order::where('status_id', 1)->count();
        $process = Order::where('status_id', 2)->count();

        return view('superadmin.transactions', compact(
            'orders',
            'completed',
            'pending',
            'process'
        ));
    }


 //REPORTS 
    public function reports()
    {
        $laporan = Order::select(
                DB::raw("COUNT(id) as total"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as bulan")
            )
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy('bulan', 'desc')
            ->get();

        return view('superadmin.reports', compact('laporan'));
    }
}