<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Technician; // BARU: dipakai untuk daftar teknisi per layanan
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    //TAMPILKAN SEMUA LAYANAN (SUPERADMIN)
    public function index()
    {
        $services = Service::latest()->get();

        return view(
            'superadmin.services',
            compact('services')
        );
    }

    //TAMPILKAN LAYANAN UNTUK PELANGGAN (menu Layanan)
    public function userServices()
    {
        $services = Service::where('status', 1)->latest()->get();

        return view(
            'layanan.index',
            compact('services')
        );
    }

    // BARU: DETAIL SATU LAYANAN + DAFTAR TEKNISINYA
    // Satu fungsi ini menggantikan lima fungsi teknisiAir/teknisiListrik/dst,
    // karena teknisi diambil lewat service_id layanan yang dipilih (bukan angka tetap).
    public function show($id)
    {
        // Hanya layanan aktif; kalau tidak ada -> halaman 404
        $service = Service::where('status', 1)->findOrFail($id);

        // Hanya teknisi aktif milik layanan ini
        $technicians = Technician::with('service')
            ->where('service_id', $service->id)
            ->where('status', 1)
            ->latest()
            ->get();

        return view(
            'layanan.show',
            compact('service', 'technicians')
        );
    }

    //FORM CREATE
    public function create()
    {
        return view('admin.services.create');
    }

    //SIMPAN LAYANAN
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required'

        ]);

        Service::create([

            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status

        ]);

        return redirect()
            ->route('superadmin.services')
            ->with(
                'success',
                'Layanan berhasil ditambahkan'
            );
    }

    //FORM EDIT
    public function edit($id)
    {
        $service = Service::findOrFail($id);

        return view(
            'admin.services.edit',
            compact('service')
        );
    }

    //UPDATE LAYANAN
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required'

        ]);

        $service = Service::findOrFail($id);

        $service->update([

            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status

        ]);

        return redirect()
            ->route('superadmin.services')
            ->with(
                'success',
                'Layanan berhasil diupdate'
            );
    }

    //TOGGLE STATUS
    public function toggle($id)
    {
        $service = Service::findOrFail($id);

        $service->update([

            'status' => $service->status == 1 ? 0 : 1

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Status layanan berhasil diubah'
            );
    }

    //HAPUS LAYANAN
    public function destroy($id)
    {
        $service = Service::findOrFail($id);

        $service->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Layanan berhasil dihapus'
            );
    }
}