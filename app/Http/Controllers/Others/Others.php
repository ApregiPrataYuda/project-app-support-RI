<?php

namespace App\Http\Controllers\Others;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class Others extends Controller
{
    protected $UserModel;
    public function __construct(UserModel $UserModel) {
    $this->UserModel = $UserModel;
}
    public function logout()
    {
        // Auth::logout();
        // return redirect('/'); // Ganti dengan rute yang sesuai setelah logout
        Auth::logout();
        Session::flush(); // Menghapus semua data session
        return redirect('/');
    }

    public function Ubah_Password_user()  {
        $userData = getUserData();
        $userID = $userData->user_id;
        $encyrptID = Crypt::encrypt($userID);
        $data = [
            'title' => 'Change Password',
            'idUser' => $encyrptID
         ];
         return view('Others/Change-Password/Form',$data);
    }


    public function Change_password_store (Request $request)  {
        $getid = $request->input('idUser');
        $iduser = Crypt::decrypt($getid);
        
        $validatedData = $request->validate([
            'password' => [
                'required',
                'min:5',
            ],
           'konfirmasi_password' => 'required|same:password',
            // Tambahkan aturan validasi lain jika perlu
        ]);
         // Temukan pengguna berdasarkan ID yang didekripsi
         $user = UserModel::find($iduser);
         // Pastikan pengguna ditemukan
         if (!$user) {
             return redirect()->back()->withErrors(['user' => 'User not found']);
         }
         // Update password pengguna
         $user->password = Hash::make($validatedData['password']);
         $user->save();
         // Redirect dengan pesan sukses
         return redirect()->route('change.password')->with('success', 'Password updated successfully');
    }


    public function Change_profile() {
        $userData = getUserData();
        $userID = $userData->user_id;
        $userData = $this->UserModel
                    ->select('ms_user.*','ms_role.role','employees.name')
                    ->join('ms_role','ms_role.role_id','=','ms_user.role_id')
                    ->Join('employees','employees.id_employee','=','ms_user.id_employee')
                    ->where('user_id', $userID)
                    ->first();
        $data = [
            'title' => 'Change Profile',
            'user' => $userData
       ];
       return view('Others/Change-Profile/Form',$data);
    }



    public function user_change_profile() {
        $userData = getUserData();
        $userID = $userData->user_id;
        $encyrptID = Crypt::encrypt($userID);
        $userData = $this->UserModel
                    ->select('ms_user.*','ms_role.role','employees.name')
                    ->join('ms_role','ms_role.role_id','=','ms_user.role_id')
                    ->Join('employees','employees.id_employee','=','ms_user.id_employee')
                    ->where('user_id', $userID)
                    ->first();
        $data = [
            'title' => 'Change Profile Your',
            'user' => $userData,
            'iduser' =>  $encyrptID
       ];
       return view('Others/Change-Profile/Form_update',$data);
    }



    public function update_profile (Request $request) {
        $iduser =  $request->input('iduser');
        $id_user = Crypt::decrypt($iduser);
       
         $validatedData = $request->validate([
             'email' => 'required|max:100|email',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
 
         $user = $this->UserModel->findOrFail($id_user);
             // ambil data gambar baru dan lama
             $newImage = $request->file('image');
             $oldImage = $request->input('imageold');
             // Jika ada gambar baru
             if ($newImage) {
                 // Simpan gambar baru di folder 'images' dalam storage 'public'
                //  $imagePath = $newImage->store('images', 'public');
                // Simpan gambar di folder app/avatar
                 $imagePath = $newImage->store('avatar'); 
                 $imageName = basename($imagePath);
 
                 // Hapus gambar lama jika ada dan bukan gambar default
                 if ($oldImage && $oldImage !== 'default.png') {
                    // Mendapatkan path ke gambar di folder storage/app/avatar/
                    $oldImagePath = storage_path('app/avatar/' . $oldImage);
                    
                    // Mengecek apakah file ada
                    if (file_exists($oldImagePath)) {
                        // Menghapus file gambar lama
                        unlink($oldImagePath);
                    }
                }
                

             } else {
                 // Jika tidak ada gambar baru, gunakan gambar lama
                 $imageName = $oldImage;
             }
 
 
             // Update data di database
             $user->update([
                 'email' => $validatedData['email'],
                 'image' => $imageName,
             ]);
             // Redirect dengan pesan sukses
             return redirect()->route('Change.Profile')->with('success', 'Data updated successfully');
 
     }
 

}
