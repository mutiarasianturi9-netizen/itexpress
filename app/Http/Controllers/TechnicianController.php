<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\Service;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    
    public function teknisiAir()
    {
        $technicians = Technician::with('service')
            ->where('service_id', 1)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('layanan.teknisi-air', compact('technicians'));
    }

    public function teknisiBangunan()
    {
        $technicians = Technician::with('service')
            ->where('service_id', 2)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('layanan.teknisi-bangunan', compact('technicians'));
    }

    public function teknisiElektronik()
    {
        $technicians = Technician::with('service')
            ->where('service_id', 3)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('layanan.teknisi-elektronik', compact('technicians'));
    }

    public function teknisiKunci()
    {
        $technicians = Technician::with('service')
            ->where('service_id', 4)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('layanan.teknisi-kunci', compact('technicians'));
    }

    public function teknisiListrik()
    {
        $technicians = Technician::with('service')
            ->where('service_id', 5)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('layanan.teknisi-listrik', compact('technicians'));
    }

    //DETAIL PEMESANAN
    public function showPemesanan($id)
    {
        $technician = Technician::with('service')
            ->findOrFail($id);

        return view('layanan.pemesanan', compact('technician'));
    }

     //SUPERADMIN TEKNISI
  
    public function index()
    {
        $technicians = Technician::with('service')
            ->latest()
            ->get();

        $services = Service::all();

        return view('superadmin.technicians', compact(
            'technicians',
            'services'
        ));
    }

    //FORM CREATE/BUAT TEKNISI
   

    public function create()
    {
        $services = Service::all();

        return view('superadmin.create-technician', compact(
            'services'
        ));
    }

     //TAMBAH TEKNISI
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|numeric',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'price_range' => 'nullable|string|max:255',

            // FOTO
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required',
            'service_id' => 'required|exists:services,id',
        ]);

        // FOTO
        $photoName = null;

        if ($request->hasFile('photo')) {

            $photo = $request->file('photo');

            $photoName = time() . '.' . $photo->getClientOriginalExtension();

            $photo->move(
                public_path('img/teknisi'),
                $photoName
            );
        }

        Technician::create([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'price_range' => $request->price_range,
            'photo' => $photoName,
            'status' => $request->status,
            'service_id' => $request->service_id,
        ]);

        return redirect()
            ->route('superadmin.technicians')
            ->with('success', 'Teknisi berhasil ditambahkan');
    }

     //DETAIL TEKNISI

    public function show($id)
    {
        $technician = Technician::with('service')
            ->findOrFail($id);

        return view('superadmin.show-technician', compact(
            'technician'
        ));
    }

     //FORM EDIT TEKNISI
  

    public function edit($id)
    {
        $technician = Technician::findOrFail($id);

        $services = Service::all();

        return view('superadmin.edit-technician', compact(
            'technician',
            'services'
        ));
    }

    //UPDATE TEKNISI
  

    public function update(Request $request, $id)
    {
        $technician = Technician::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|numeric',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'price_range' => 'nullable|string|max:255',

            // FOTO
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'status' => 'required',
            'service_id' => 'required|exists:services,id',
        ]);

        // FOTO 
        $photoName = $technician->photo;

        // JIKA ADA FOTO BARU
        if ($request->hasFile('photo')) {

            // HAPUS FOTO LAMA
            if (
                $technician->photo &&
                file_exists(
                    public_path('img/teknisi/' . $technician->photo)
                )
            ) {

                unlink(
                    public_path('img/teknisi/' . $technician->photo)
                );
            }

            // SIMPAN FOTO BARU
            $photo = $request->file('photo');

            $photoName = time() . '.' .
                $photo->getClientOriginalExtension();

            $photo->move(
                public_path('img/teknisi'),
                $photoName
            );
        }

        $technician->update([
            'name' => $request->name,
            'age' => $request->age,
            'phone' => $request->phone,
            'address' => $request->address,
            'price_range' => $request->price_range,
            'photo' => $photoName,
            'status' => $request->status,
            'service_id' => $request->service_id,
        ]);

        return redirect()
            ->route('superadmin.technicians')
            ->with('success', 'Teknisi berhasil diupdate');
    }

    
    //NONAKTIFKAN TEKNISI
   
    public function disable($id)
    {
        $technician = Technician::findOrFail($id);

        $technician->update([
            'status' => 0
        ]);

        return redirect()
            ->back()
            ->with('success', 'Teknisi berhasil dinonaktifkan');
    }

     //AKTIFKAN TEKNISI
   
    public function enable($id)
    {
        $technician = Technician::findOrFail($id);

        $technician->update([
            'status' => 1
        ]);

        return redirect()
            ->back()
            ->with('success', 'Teknisi berhasil diaktifkan');
    }

     //HAPUS TEKNISI
   
    public function destroy($id)
    {
        $technician = Technician::findOrFail($id);

        // HAPUS FOTO
        if (
            $technician->photo &&
            file_exists(
                public_path('img/teknisi/' . $technician->photo)
            )
        ) {

            unlink(
                public_path('img/teknisi/' . $technician->photo)
            );
        }

        $technician->delete();

        return redirect()
            ->route('superadmin.technicians')
            ->with('success', 'Teknisi berhasil dihapus');
    }
}