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
        $user->save();

        return redirect('/login')->with('successRegist', 'Akun berhasil didaftarkan');
    }

    public function storeLogin(Request $request)
    {   {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

                if (Auth::user()->role_user === 1) {
                    $response = new Response(redirect('/admin/dashboard')->with('berhasilLogin', 'Selamat Datang Di WebsiteKita'));
                } elseif (Auth::user()->role_user === 0 ) {
                    $response = new Response(redirect('/profile')->with('berhasilLogin', 'Selamat Datang Di WebsiteKita'));
                }
                return $response;
            } else {

                return redirect('/login')->with('error', 'Email atau Password tidak sesuai');
            }
        }

    }

    public function profilePage()
    {
        $apiKey = "6abe431a61b948335187e364e0145695337c6de46f06165c6cbab537dc28a49a";

        $responseProvinsi = Http::get("https://api.binderbyte.com/wilayah/provinsi", [
            'api_key' => $apiKey,
        ]);

        if (!$responseProvinsi->successful()) {
            return response()->json(['error' => 'Failed to retrieve provinsi data.'], 500);
        }

        $provinsiData = $responseProvinsi->json();

        return view('profile', compact('provinsiData', 'apiKey'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
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

        if ($request->hasFile("imgProfile")) {
            $request->file("imgProfile")->move("images/", $request->file("imgProfile")->getClientOriginalName());
            $userID->imgProfile = $request->file("imgProfile")->getClientOriginalName();
            $userID->save();
        }

        $user = DB::table('users')->find($userID);

        if ($user) {
            $updated = DB::table('users')->where('id', $userID)->update($newUserData);

            if ($updated) {
                return redirect()->back()->with('successUpdate', "Profil berhasil diperbarui");
            } else {
                return redirect()->back()->with('updateProfile', "Gagal memperbarui profil. Silakan coba lagi.");
            }
        } else {
            return redirect()->back()->with('updateProfile', "Gagal memperbarui profil. Pengguna tidak ditemukan");
        }
    }

    public function createuser()
    {
        $apiKey = "6abe431a61b948335187e364e0145695337c6de46f06165c6cbab537dc28a49a";

        $responseProvinsi = Http::get("https://api.binderbyte.com/wilayah/provinsi", [
            'api_key' => $apiKey,
        ]);

        if (!$responseProvinsi->successful()) {
            return response()->json(['error' => 'Failed to retrieve provinsi data.'], 500);
        }

        $provinsiData = $responseProvinsi->json();
        return view('admin.adminCreate', compact(['provinsiData', 'apiKey']));
    }

    public function createuserStore(Request $request)
    {
        UserModel::create($request->all());
        return redirect('/admin/dashboard');
    }

    public function updateUser($id)
    {
        $getUser = UserModel::findOrFail($id);
        $apiKey = "6abe431a61b948335187e364e0145695337c6de46f06165c6cbab537dc28a49a";

        $responseProvinsi = Http::get("https://api.binderbyte.com/wilayah/provinsi", [
            'api_key' => $apiKey,
        ]);

        if (!$responseProvinsi->successful()) {
            return response()->json(['error' => 'Failed to retrieve provinsi data.'], 500);
        }

        $provinsiData = $responseProvinsi->json();
        return view('admin.adminUpdate', compact(["getUser", "apiKey", "provinsiData"]));
    }

    public function updateUserStore($id, Request $request)
    {
        $updateUser = UserModel::findOrFail($id);
        $updateUser->update($request->all());

        if ($request->hasFile("imgProfile")) {
            $request->file("imgProfile")->move("images/", $request->file("imgProfile")->getClientOriginalName());
            $updateUser->imgProfile = $request->file("imgProfile")->getClientOriginalName();
            $updateUser->save();
        }

        return redirect("/admin/dashboard");
    }

    public function deleteUserStore($id)
    {
        $hapusUser = UserModel::find($id)->delete();
        return redirect()->back();
    }
}