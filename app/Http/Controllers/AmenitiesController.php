<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenitiesController extends Controller
{
    public function index(){
        // Ambil data amenities dari model
        $data = Amenity::paginate(10);

        return view('pages.amenities.index', compact('data'));
    }

    // Ini untuk menampilkan halaman create amenity
    public function create(){
        return view('pages.amenities.create');
    }

    // Ini untuk menyimpan data amenity baru
    public function store(Request $request){
        $request->validate([
            'name' => "required",
            'icon_key' => "required"
        ]);

        Amenity::create([
            'name' => $request->name,
            'icon_key' => $request->icon_key
        ]);

        return redirect()->route('amenities.index')->with('success', 'Amenity created successfully.');
    }

    public function destroy(Amenity $amenity){
        $amenity->delete();
        return redirect()->route('amenities.index')->with('success', 'Amenity deleted successfully.');
    }

    public function edit(Amenity $amenity){
        return view('pages.amenities.edit', [
            'data' => $amenity
        ]);
    }

    public function update(Request $request, Amenity $amenity){
         $request->validate([
            'name' => "required",
            'icon_key' => "required"
        ]);

        $amenity->update([
            'name' => $request->name,
            'icon_key' => $request->icon_key
        ]);

        return redirect()->route('amenities.index')->with('success', 'Amenity updated successfully.');
    }
}
