<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('owner.edit-profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        // 1. Validasi Input
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'business_category' => 'required|string',
            'business_address' => 'required|string',
            'business_phone' => 'required|string|max:20',
            'business_email' => 'nullable|email|max:255',
            'business_description' => 'nullable|string',
            'business_map' => 'nullable|url',
            'business_instagram' => 'nullable|string',
            'business_hours' => 'nullable|string',
            'show_stock' => 'required|boolean',
            'business_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Handle Upload Foto jika ada
        if ($request->hasFile('business_photo')) {
            // Hapus foto lama jika ada (opsional, tapi disarankan agar storage tidak penuh)
            if ($user->business_photo && Storage::disk('public')->exists($user->business_photo)) {
                Storage::disk('public')->delete($user->business_photo);
            }

            // Simpan foto baru
            $path = $request->file('business_photo')->store('business-profiles', 'public');
            $validatedData['business_photo'] = $path;
        }

        // 3. Update Data User
        // Kita gunakan query builder atau method update pada model instance
        /** @var \App\Models\User $user */
        $user->update($validatedData);

        return redirect()->route('owner.profil')->with('success', 'Profil UMKM berhasil diperbarui!');
    }
}
