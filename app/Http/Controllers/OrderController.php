<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Technician;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
     //FORM PEMESANAN
    
    public function create($id)
    {
        $technician = Technician::with('service')->findOrFail($id);

        return view('layanan.pemesanan', compact('technician'));
    }

     //SIMPAN PEMESANAN
    
    public function store(Request $request)
    {
        $request->validate([
            'technician_id' => 'required',
            'service_id' => 'required',
            'customer_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'date' => 'required',
            'problem' => 'required',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $user_id = Auth::check() ? Auth::id() : 1;

        $photoName = null;

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');

            $photoName = time() . '.' . $photo->extension();

            $photo->move(public_path('img/orders'), $photoName);
        }

        Order::create([
            'user_id' => $user_id,
            'technician_id' => $request->technician_id,
            'service_id' => $request->service_id,

            // STATUS DEFAULT = PENDING
            'status_id' => 1,

            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'date' => $request->date,
            'problem' => $request->problem,
            'photo' => $photoName,
        ]);

      return back()->with(
        'success',
        'Pesanan berhasil dipesan'
    );
}

    //ADMIN ORDER LIST
    
    public function index()
    {
        $orders = Order::with([
                'technician',
                'service',
                'status',
                'user'
            ])
            ->latest()
            ->get();

        return view('admin.orders.index', [
            'orders' => $orders,
            'completedOrders' => Order::where('status_id', 3)->count(),
            'pendingOrders' => Order::where('status_id', 1)->count(),
            'processOrders' => Order::where('status_id', 2)->count(),
            'totalOrders' => Order::count(),
        ]);
    }

     //UPDATE STATUS
   
    public function process($id)
    {
        Order::findOrFail($id)->update([
            'status_id' => 2
        ]);

        return back();
    }

    public function complete($id)
    {
        Order::findOrFail($id)->update([
            'status_id' => 3
        ]);

        return back();
    }

   //USER ACTIVITY
    
    public function dalamProses()
    {
        $orders = Order::with([
                'status',
                'technician',
                'service'
            ])
            ->where('user_id', Auth::id())
            ->where('status_id', 2)
            ->latest()
            ->get();

        return view('activity.dalam-proses', compact('orders'));
    }

    public function riwayat()
    {
        $orders = Order::with([
                'status',
                'technician',
                'service'
            ])
            ->where('user_id', Auth::id())
            ->where('status_id', 3)
            ->latest()
            ->get();

        return view('activity.riwayat', compact('orders'));
    }

    //REVIEW
   
    public function ulasan()
    {
        $reviews = Review::with(['order.technician'])
            ->whereHas('order', function ($query) {

                $query->where('user_id', auth()->id());

            })
            ->latest()
            ->get();

        return view('ulasan', compact('reviews'));
    }
}