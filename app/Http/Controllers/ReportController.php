<?php

namespace App\Http\Controllers;


use App\Models\Pengaduan;
use App\Models\Komentar;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\TipePengaduan;
use App\Models\StatusPengaduan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengaduanExport;
use App\Exports\ReportExcel;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{
        

    // public function reportView()
    // {
    //     $user = Auth::user();
    //     $provinsi = $user->provinsi;

    //     $pengaduans = Pengaduan::with('status', 'tipePengaduan', 'user')
    //     ->where('provinsi', $provinsi)
    //     ->withCount(['likes as total_likes'])
    //     ->latest()
    //     ->get();
    //     $tipePengaduans = TipePengaduan::all();
    //     $search = null;

    //     return view('petugas.index', compact('pengaduans', 'tipePengaduans', 'search', 'user', 'provinsi'));
    // }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->with('status', 'tipePengaduan')
            ->when($search, function ($query, $search) {
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
            ->orderBy('created_at', 'asc')
            ->paginate(5) 
            ->appends(['search' => $search]);

        $tipePengaduans = TipePengaduan::all();
        return view('masyarakat.index', compact('pengaduans', 'search', 'tipePengaduans'));

        // dd('index');
    }
    public function indexAll(Request $request)
    {
        $search = $request->query('search');

        $pengaduans = Pengaduan::where('user_id', Auth::id())
            ->with('status', 'tipePengaduan')
            ->when($search, function ($query, $search) {
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
            ->orderBy('created_at', 'asc')
            ->paginate(5) 
            ->appends(['search' => $search]);

        $tipePengaduans = TipePengaduan::all();
        return view('masyarakat.showAll', compact('pengaduans', 'search', 'tipePengaduans'));

        // dd('index');
    }

    public function create()
    {
        $tipePengaduans = TipePengaduan::all();
        return view('pengaduan.create', compact('tipePengaduans'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_pengaduan_id' => 'required|exists:tipe_pengaduans,id',
            'provinsi' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'keluhan' => 'required|string',
            'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = $request->file('gambar')->store('gambar_pengaduan', 'public');

        // $user = auth()->user();
        // if (!$user) {
        //     return redirect()->back()->with('error', 'Kamu harus login dulu untuk mengirim pengaduan.');
        // }
        Pengaduan::create([
            'user_id' => Auth::user()->id, // pastikan user login
            'tipe_pengaduan_id' => $validated['tipe_pengaduan_id'],
            'provinsi' => $validated['provinsi'],
            'kota_kabupaten' => $validated['kota_kabupaten'],
            'kecamatan' => $validated['kecamatan'],
            'kelurahan' => $validated['kelurahan'],
            'keluhan' => $validated['keluhan'],
            'gambar' => $gambar,
            'status_pengaduan_id' => 1 // default pending
        ]);
        return redirect()->route('masyarakat.index')->with('success', 'Pengaduan berhasil dikirim');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $pengaduan = Pengaduan::with('tipePengaduan', 'status', 'user')->findOrFail($id);
        return view('petugas.create', compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);
        $tipePengaduans = TipePengaduan::all();
        return view('masyarakat.edit', compact('pengaduan', 'tipePengaduans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipe_pengaduan_id' => 'required|exists:tipe_pengaduans,id',
            'provinsi' => 'required|string',
            'kota_kabupaten' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'keluhan' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        // Update manual satu per satu
        $pengaduan->tipe_pengaduan_id = $request->tipe_pengaduan_id;
        $pengaduan->provinsi = $request->provinsi;
        $pengaduan->kota_kabupaten = $request->kota_kabupaten;
        $pengaduan->kecamatan = $request->kecamatan;
        $pengaduan->kelurahan = $request->kelurahan;
        $pengaduan->keluhan = $request->keluhan;

        // Jika user upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($pengaduan->gambar && Storage::disk('public')->exists($pengaduan->gambar)) {
                Storage::disk('public')->delete($pengaduan->gambar);
            }

            // Simpan gambar baru
            $gambarBaru = $request->file('gambar')->store('gambar_pengaduan', 'public');
            $pengaduan->gambar = $gambarBaru;
        }

        $pengaduan->save();

        return redirect()->route('masyarakat.index')->with('success', 'Pengaduan berhasil diperbarui');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_pengaduan_id' => 'required|exists:status_pengaduans,id',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status_pengaduan_id = $request->status_pengaduan_id;
        $pengaduan->save();

        return redirect()->route('petugas.report')->with('success', 'Status pengaduan berhasil diubah');
    }

    public function aksiGabungan(Request $request, $id)
    {
        $request->validate([
            'status_pengaduan_id' => 'required|exists:status_pengaduans,id',
            'isi' => 'nullable|string',
        ]);

        // update status pengaduan
        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->status_pengaduan_id = $request->status_pengaduan_id;
        $pengaduan->save();
        $pengaduan->load('status');

        // simpan komentar
        if ($request->filled('isi')) {
            Komentar::create([
                'pengaduan_id' => $id,
                'isi' => $request->isi,
                'user_id' =>Auth::user()->id,
            ]);

        }
            return redirect()->route('dashboard')->with('success', 'Status pengaduan berhasil diproses');
    }

    public function like(Request $request, $id)
    {
        try {
        $pengaduan = Pengaduan::findOrFail($id);
        $ipAddress = $request->ip();

        // Cek apakah sudah ada like dalam waktu 1 menit
        $recentLike = Like::where('pengaduan_id', $id)
            ->where('ip_address', $ipAddress)
            ->where('created_at', '>=', now()->subMinutes(1))
            ->first();

        if ($recentLike) {
            return response()->json([
                'message' => 'Please wait before liking again',
                'status' => false,
                'likes_count' => $pengaduan->likes()->count(),
            ]);
        }

        // Simpan like baru
        $like = new Like();
        $like->pengaduan_id = $id;
        $like->ip_address = $ipAddress;
        $like->save();

        return response()->json([
            'message' => 'Liked successfully',
            'status' => true,
            'likes_count' => $pengaduan->likes()->count(),
        ]);
    }catch (\Throwable $e) {
        return response()->json([
            'error' => $e->getMessage(),
        ], 500);
    }
}

    // public function export(Request $request)
    // {
    //     $user = Auth::user();
    //     $userId = $user->id;
    //     $role = $user->role;

    //     if ($role === 'petugas') {
    //         // Ambil provinsi petugas
    //         $provinsiId = $user->provinsi;

    //         // Filter pengaduan berdasarkan provinsi
    //         $query = Pengaduan::where('provinsi', $provinsiId);
    //     } else {
    //         // Masyarakat hanya melihat data sendiri
    //         $query = Pengaduan::where('user_id', $userId);
    //     }

    //     // Filter opsional
    //     // if ($request->filled('status_pengaduan_id')) {
    //     //     $query->where('status_pengaduan_id', $request->status_pengaduan_id);
    //     // }

    //     // if ($request->filled('tipe_pengaduan_id')) {
    //     //     $query->where('tipe_pengaduan_id', $request->tipe_pengaduan_id);
    //     // }

    //     // if ($request->filled('start_date') && $request->filled('end_date')) {
    //     //     $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
    //     // }

    //     $pengaduans = $query->get();

    //     // Cek jika tidak ada data
    //     if ($pengaduans->isEmpty()) {
    //         return redirect()->back()->with('error', 'Tidak ada data yang sesuai.');
    //     }

    //     return Excel::download(new ReportExcel($pengaduans), 'pengaduan.xlsx');
    // }

   public function export(Request $request)
{
    $user = Auth::user();

    if (!$user) {
        // Jika guest (tidak login), ambil semua data
        $pengaduans = Pengaduan::with(['user', 'tipePengaduan', 'status'])->get();
    } else {
        // Jika login dan masyarakat, hanya data dirinya
        if ($user->role === 'masyarakat') {
            $pengaduans = Pengaduan::with(['user', 'tipePengaduan', 'status'])
                                   ->where('user_id', $user->id)
                                   ->get();
        }
        // Jika login dan petugas, berdasarkan provinsi
        else if ($user->role === 'petugas') {
            $pengaduans = Pengaduan::with(['user', 'tipePengaduan', 'status'])
                                   ->where('provinsi', $user->provinsi)
                                   ->get();
        }
        // Selain itu (admin/superadmin), ambil semua data
        else {
            $pengaduans = Pengaduan::with(['user', 'tipePengaduan', 'status'])->get();
        }
    }

    if ($pengaduans->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada data yang sesuai.');
    }

    return Excel::download(new ReportExcel($pengaduans), 'pengaduan.xlsx');
}

public function incrementViewCount($id)
{
    $pengaduan = Pengaduan::findOrFail($id);

    // Meningkatkan view_count
    $pengaduan->view_count += 1;
    $pengaduan->save();

    return response()->json([
    'success' => true,
    'view_count' => $pengaduan->view_count,
]);

}

public function tambahView(Request $request, $id)
{
    if (!Auth::check()) {
        $key = 'viewed_pengaduan_' . $id;
        $lastViewed = session($key);
        $now = now();

        if (!$lastViewed || $now->diffInMinutes($lastViewed) >= 1) {
            Pengaduan::where('id', $id)->increment('view_count');
            session()->put($key, $now);
        }

        return response()->json(['message' => 'View ditambahkan']);
    }

    return response()->json(['message' => 'User login, view tidak ditambahkan'], 403);
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::find($id);

        if(!$pengaduan) {
            return redirect()->back()->with('error', 'gagal mas');
        }
        
        $pengaduan->delete();

        return redirect()->back()->with('success', 'Pengaduan berhasil dihapus');
    }
}
