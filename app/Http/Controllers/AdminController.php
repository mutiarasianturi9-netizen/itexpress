<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    
    public function dashboard(Request $request)
    {
        $search = $request->search;

        $totalOrders = Order::count();

        $orders = Order::with('user')
            ->when($search, function ($query) use ($search) {

                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });

            })
            ->latest()
            ->take(5)
            ->get();

        $totalReviews = Review::count();

        $reviews = Review::with('order.user')
            ->latest()
            ->take(4)
            ->get();

        $pendingOrders = Order::where('status_id', 1)->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'orders',
            'totalReviews',
            'reviews',
            'pendingOrders'
        ));
    }

    //USERADMIN
    public function usersIndex()
    {
        $users = User::where('role_id', 3)->get();

        return view('admin.users.index', compact('users'));
    }
      public function disableUser($id)
    {
        $user = User::findOrFail($id);

        $user->status = 'nonaktif';

        $user->save();

        return back()->with('success', 'User berhasil dinonaktifkan');
    }

    // AKTIFKAN USER
    public function enableUser($id)
    {
        $user = User::findOrFail($id);

        $user->status = 'aktif';

        $user->save();

        return back()->with('success', 'User berhasil diaktifkan');
    }

   //TAMBAH ADMIN
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,

            // WAJIB HASH PASSWORD
            'password' => bcrypt($request->password),

            // ROLE ADMIN
            'role_id' => 2,

            // STATUS DEFAULT
            'status' => 'aktif',
        ]);

        return redirect()->back()->with('success', 'Admin berhasil ditambahkan');
    }

    
     //ORDERS
   
    public function orders()
    {
        $orders = Order::with(['technician', 'service'])
            ->latest()
            ->get();

        $completedOrders = Order::where('status_id', 3)->count();
        $pendingOrders = Order::where('status_id', 1)->count();
        $processOrders = Order::where('status_id', 2)->count();
        $totalOrders = Order::count();

        return view('admin.orders', compact(
            'orders',
            'completedOrders',
            'pendingOrders',
            'processOrders',
            'totalOrders'
        ));
    }
    //KONTAK

        public function contacts()
    {
        $contacts = Contact::latest()->get();

        return view('admin.contacts', compact('contacts'));
    }

//reviews
    public function reviews()
    {
        $reviews = Review::with('order.user')->latest()->get();

        $averageRating = Review::avg('rating');

        $totalReviews = Review::count();

        $fiveStar = Review::where('rating', 5)->count();
        $fourStar = Review::where('rating', 4)->count();
        $threeStar = Review::where('rating', 3)->count();
        $twoStar = Review::where('rating', 2)->count();
        $oneStar = Review::where('rating', 1)->count();

        return view('admin.reviews', compact(
            'reviews',
            'averageRating',
            'totalReviews',
            'fiveStar',
            'fourStar',
            'threeStar',
            'twoStar',
            'oneStar'
            
        ));

    }
}

   