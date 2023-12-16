<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function storeRegister(Request $request)
    {

        $existingUser = UserModel::where('email', $request->email)->first();
        if ($existingUser) {
            return redirect()->back()->with('error', 'Alamat email sudah terdaftar');
        }
        $user = new UserModel();
        $user->namaLengkap = $request->namaLengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // $user->remember_token = Str::random(60);
        $user->save();
        // dd($user);
        return redirect()->back()->with('successRegist', 'Akun berhasil didaftarkan 😍');
    }

    public function storeLogin(Request $request)
    { {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                $response = new Response(redirect('/profile')->with('berhasilLogin', 'Selamat Datang Di Pyarr'));
                return $response;
            } else {
                return redirect()->back()->with('wrongAuth', 'Email atau Password tidak sesuai');
            }
        }
    }


    public function profilePage()
    {
        $apiKey = "6abe431a61b948335187e364e0145695337c6de46f06165c6cbab537dc28a49a";
        //get apikey yg di dapat

        $responseProvinsi = Http::get("https://api.binderbyte.com/wilayah/provinsi", [
            'api_key' => $apiKey,
        ]);

        if (!$responseProvinsi->successful()) {
            return response()->json(['error' => 'Failed to retrieve provinsi data.'], 500);
        }

        $provinsiData = $responseProvinsi->json();

        return view('profile', compact('provinsiData', 'apiKey'));
    }

    public function profileUpdate(Request $request)
    {
        $userID = Auth::user()->id;
        $newUserData = [
            'namaLengkap' => $request->input('namaLengkap'),
            'alamatKTP' => $request->input('alamatKTP'),
            'alamatSaatIni' => $request->input('alamatSaatIni'),
            'provinsi' => $request->input('provinsi'),
            'kabupaten' => $request->input('kabupaten'),
            'kecamatan' => $request->input('kecamatan'),
            'noHp' => $request->input('noHp'),
            'noTelpon' => $request->input('noTelpon'),
            'kewarganegaraan' => $request->input('kewarganegaraan'),
            'asalWNA' => $request->input('asalWNA'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'tmp_lahir' => $request->input('tmp_lahir'),
            'jk' => $request->input('jk'),
            'statusMenikah' => $request->input('statusMenikah'),
            'agama' => $request->input('agama'),
        ];

        $user = DB::table('users')->find($userID);

        if ($user) {
            $updated = DB::table('users')->where('id', $userID)->update($newUserData);

            if ($updated) {
                return redirect()->back()->with('updateProfile', "Profil berhasil diperbarui");
            } else {
                return redirect()->back()->with('updateProfile', "Gagal memperbarui profil. Silakan coba lagi.");
            }
        } else {
            return redirect()->back()->with('updateProfile', "Gagal memperbarui profil. Pengguna tidak ditemukan");
        }
    }
}