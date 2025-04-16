<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Models\TipePengaduan;
use App\Models\StatusPengaduan;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $search = $request->query(key:"search");

        $statusCounts = [];
        $topDaerah = [];

        // masyarakat 
        if($user->role == 'masyarakat'){
            $pengaduans = Pengaduan::where('user_id', $user->id)
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

            return view('dashboard', compact('pengaduans', 'tipePengaduans', 'search', 'statusCounts', 'topDaerah'));
        }

        // petugas
        if ($user->role === 'petugas') {
        $status = $request->query('status');

            $pengaduans = Pengaduan::with('status', 'tipePengaduan')
                ->where('provinsi', $user->provinsi) // filter sesuai provinsi petugas
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
                ->when($status, fn($q) => $q->where('status_pengaduan_id', $status))
                ->orderBy('created_at', 'asc')
                ->paginate(5)
                ->appends(['search' => $search]);

            $tipePengaduans = TipePengaduan::all();
        $statuses = StatusPengaduan::all();


            return view('dashboard', compact('pengaduans', 'tipePengaduans', 'search', 'statusCounts', 'topDaerah', 'statuses'));
        }

        // admin
        if ($user->role === 'admin') {
            $pengaduans = Pengaduan::with('status', 'tipePengaduan')
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
                ->paginate(10)
                ->appends(['search' => $search]);
    
            // statistik untuk admin
            $statusCounts = DB::table('pengaduans')
                ->join('status_pengaduans', 'pengaduans.status_pengaduan_id', '=', 'status_pengaduans.id')
                ->select('status_pengaduans.status_pengaduan', DB::raw('count(*) as total'))
                ->groupBy('status_pengaduans.status_pengaduan')
                ->pluck('total', 'status_pengaduans.status_pengaduan');
    
            $topDaerah = Pengaduan::select('provinsi', DB::raw('count(*) as total'))
                ->groupBy('provinsi')
                ->orderByDesc('total')
                ->limit(5)
                ->get();
    
            $tipePengaduans = TipePengaduan::all();
    
            return view('dashboard', compact('pengaduans', 'tipePengaduans', 'search', 'statusCounts', 'topDaerah'));
        }

        return abort (code: 403);
    }
}
