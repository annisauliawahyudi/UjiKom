<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Pengaduan;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StatusPengaduan;
use App\Models\TipePengaduan;
use App\Http\Controllers\Controller;

class ComentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $pengaduans = Pengaduan::all(); 
        $sessionId = session()->getId(); 
        $search = $request->query('search');
        $provinsi = $request->query('provinsi');
        $status = $request->query('status');
        $tipe = $request->query('tipe');

        $pengaduans = Pengaduan::when($search, function($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('provinsi', 'like', '%' . $search . '%')
                    ->orWhere('kota_kabupaten', 'like', '%' . $search . '%')
                    ->orWhere('kecamatan', 'like', '%' . $search . '%')
                    ->orWhere('kelurahan', 'like', '%' . $search . '%')
                    ->orWhere('keluhan', 'like', '%' . $search . '%')
                    ->orWhereHas('tipePengaduan', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                });
            });
        })
        ->when($provinsi, fn($q) => $q->where('provinsi', $provinsi))
        ->when($status, fn($q) => $q->where('status_pengaduan_id', $status))
        ->when($tipe, fn($q) => $q->where('tipe_pengaduan_id', $tipe))
        ->orderBy('created_at', 'desc') // optional: biar terbaru muncul dulu
        ->get();

            foreach ($pengaduans as $pengaduan) {
            $pengaduan->user_like = Like::where('pengaduan_id', $pengaduan->id)
                                ->where('session_id', $sessionId)
                                ->exists();
}


        $provinsis = Pengaduan::select('provinsi')->distinct()->pluck('provinsi');
        $statuses = StatusPengaduan::all();
        $tipePengaduans = TipePengaduan::all();
        return view('welcome', compact('pengaduans', 'search', 'provinsi', 'status', 'tipe', 'provinsis', 'statuses', 'tipePengaduans'));
    }
    public function indexMasyarakat(Request $request)
    {
        $pengaduans = Pengaduan::all(); 
        $sessionId = session()->getId(); 
        $search = $request->query('search');
        $provinsi = $request->query('provinsi');
        $status = $request->query('status');
        $tipe = $request->query('tipe');

        $pengaduans = Pengaduan::when($search, function($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('provinsi', 'like', '%' . $search . '%')
                    ->orWhere('kota_kabupaten', 'like', '%' . $search . '%')
                    ->orWhere('kecamatan', 'like', '%' . $search . '%')
                    ->orWhere('kelurahan', 'like', '%' . $search . '%')
                    ->orWhere('keluhan', 'like', '%' . $search . '%')
                    ->orWhereHas('tipePengaduan', function ($q2) use ($search) {
                        $q2->where('nama', 'like', '%' . $search . '%');
                });
            });
        })
        ->when($provinsi, fn($q) => $q->where('provinsi', $provinsi))
        ->when($status, fn($q) => $q->where('status_pengaduan_id', $status))
        ->when($tipe, fn($q) => $q->where('tipe_pengaduan_id', $tipe))
        ->orderBy('created_at', 'desc') // optional: biar terbaru muncul dulu
        ->get();

            foreach ($pengaduans as $pengaduan) {
            $pengaduan->user_like = Like::where('pengaduan_id', $pengaduan->id)
                                ->where('session_id', $sessionId)
                                ->exists();
}


        $provinsis = Pengaduan::select('provinsi')->distinct()->pluck('provinsi');
        $statuses = StatusPengaduan::all();
        $tipePengaduans = TipePengaduan::all();
        return view('masyarakat.show-all', compact('pengaduans', 'search', 'provinsi', 'status', 'tipe', 'provinsis', 'statuses', 'tipePengaduans'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $pengaduanId)
    {
        $validated = $request->validate([
            'isi' => 'required|string|max:255',
            'guest_name' => 'nullable|string',
            'tipe_komentator' => 'required|in:user,guest',
        ]);

        $user_id = Auth::check() ? Auth::id() : null;
        $guest_name = Auth::check() ? null : $request->guest_name;

        Komentar::create([
            'isi' => $validated['isi'],
            'pengaduan_id' => $pengaduanId, 
            'user_id' => $user_id,
            'guest_name' => $guest_name,
            'tipe_komentator' => $validated['tipe_komentator'],
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengaduan  = Pengaduan::with('user', 'komentars')->findOrFail($id);
        return view('modalDetail', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(string $id)
    {
        $komentar = Komentar::findOrFail($id);

        // Cek jika user login dan role-nya adalah petugas
        if (Auth::check() && Auth::user()->role === 'petugas') {
            $komentar->delete();
            return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
        }

        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini!');
    }

}
