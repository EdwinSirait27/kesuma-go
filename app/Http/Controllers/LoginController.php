<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ppdb;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        $ppdbs = ppdb::where('start_date', '<=', now())
        ->where('end_date', '>=', now())
        ->get();
        return view('login.login', compact('ppdbs'));
    }
    public function postlogin(Request $request)
    {
    $ppdbs = ppdb::all();
    $validatedData = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);
   Log::info('User ' . $validatedData['username'] . ' is attempting to log in.');
    $credentials = [
        'username' => $validatedData['username'],
        'password' => $validatedData['password'],
    ];
    if (Auth::attempt($credentials, $request->has('remember'))) {
        $user = Auth::user();
        Log::info('User ' . $user->username . ' logged in successfully.');
  $redirectPath = $this->getRedirectPath($user->hakakses);
        return redirect($redirectPath);
    } else {
        $userExists = User::where('username', $validatedData['username'])->exists();
        if ($userExists) {
            $error = "Password Salah, Silahkan Coba Kembali";
        } else {
            $error = "Username Salah atau Tidak Terdaftar";
        }
        Log::warning('Login attempt failed for user ' . $validatedData['username']);
        return view('login.login', compact('error','ppdbs'));
    }
}

    private function getRedirectPath($hakakses)
    {
        switch ($hakakses) {
            case 'Admin':
                return 'AdminBeranda';
            case 'Siswa':
                return 'SiswaBeranda';
            case 'NonSiswa':
                return 'NonSiswaBeranda';
            case 'Guru':
                return 'GuruBeranda';
            case 'Kurikulum':
                return 'KurikulumBeranda';
            case 'KepalaSekolah':
                return 'KepalaSekolahBeranda';
            case 'SU':
                return 'SUBeranda'; 
            default:
                abort(403, 'Forbidden'); 
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return redirect('/');
    }
}
// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use App\Models\User;
// use App\Models\ppdb;
// use Illuminate\Support\Facades\Log;

// class LoginController extends Controller
// {
//     public function postlogin(Request $request)
//     {
//     $ppdbs = ppdb::all();
//     $validatedData = $request->validate([
//         'username' => 'required|string',
//         'password' => 'required|string',
//     ]);
//    Log::info('User ' . $validatedData['username'] . ' is attempting to log in.');
//     $credentials = [
//         'username' => $validatedData['username'],
//         'password' => $validatedData['password'],
//     ];
//     if (Auth::attempt($credentials, $request->has('remember'))) {
//         $user = Auth::user();
//         Log::info('User ' . $user->username . ' logged in successfully.');
//   $redirectPath = $this->getRedirectPath($user->hakakses);
//         return redirect($redirectPath);
//     } else {
//         $userExists = User::where('username', $validatedData['username'])->exists();
//         if ($userExists) {
//             $error = "Password Salah, Silahkan Coba Kembali";
//         } else {
//             $error = "Username Salah atau Tidak Terdaftar";
//         }
//         Log::warning('Login attempt failed for user ' . $validatedData['username']);
//         return view('login.login', compact('error','ppdbs'));
//     }
// }

//     private function getRedirectPath($hakakses)
//     {
//         switch ($hakakses) {
//             case 'Admin':
//                 return 'AdminBeranda';
//             case 'Siswa':
//                 return 'SiswaBeranda';
//             case 'Guru':
//                 return 'GuruBeranda';
//             case 'Kurikulum':
//                 return 'KurikulumBeranda';
//             case 'KepalaSekolah':
//                 return 'KepalaSekolahBeranda';
//             case 'SU':
//                 return 'SUBeranda'; 
//             default:
//                 abort(403, 'Forbidden'); 
//         }
//     }
//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->regenerate();
//         return redirect('/');
//     }
// }
