<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function indexAdmin(Request $request)
{
    $search = $request->query('search');

    $users = User::where('role', 'admin')
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        })
        ->paginate(2)
        ->appends(['search' => $search]);

    return view('admin.AdminAcount', compact('users', 'search'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,petugas,masyarakat',
            'provinsi' => 'required|string',
            'password' => 'required|string|min:6,'
        ]);

        User::create([  
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'provinsi' => $validated['provinsi'],
            'password' => Hash::make($validated['password']),
        ]);
        
        return redirect()->route('admin.user.petugas')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return view("admin.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       $user = User::findOrFail($id);

       $user->name = $request->name;
       $user->email = $request->email;
       $user->provinsi = $request->provinsi;

       if($request->password) {
        $user->password = Hash::make($request->password);
       }

       $user->role = $request->role;
       $user->save();

        return redirect()->route('admin.user.petugas')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.user.petugas')->with('success', 'User berhasil dihapus!');
    }

    // petugas
    public function index(Request $request) 
    {
        $search = $request->query('search');

        $users = User::where('role', 'petugas')
        ->when($search, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%");
            });
        })
        ->paginate(5)
        ->appends(['search' => $search]);

        return view('admin.index', compact('users', 'search'));
    }
}
