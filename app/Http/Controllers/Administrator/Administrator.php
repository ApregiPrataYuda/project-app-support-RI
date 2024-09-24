<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\SubmenuModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
class Administrator extends Controller
{
     protected $MenuModel;
     protected $SubmenuModel;
    public function __construct(MenuModel $MenuModel, SubmenuModel $SubmenuModel) {
        $this->MenuModel = $MenuModel;
        $this->SubmenuModel = $SubmenuModel;
    }

    public  function index() {
        $data = [
            'title' => 'Administrator'
         ];
         return view('Administrator/Dashboard/Data/file',$data);
    }

    public function menu_management ()  {
        $data = [
            'title' => 'Menu Management'
         ];
         return view('Administrator/Menu-management/Data/file',$data);
    }

      //code for get data 
      public function get_menu_data(Request $request) {
        if ($request->ajax()) {
            // Mengambil data dari model dengan join
            $data = $this->MenuModel->select('*');
        
            // Cek apakah ada parameter pencarian
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                // Pastikan kolom fullname ada di ms_user
                $data->where('menu', 'LIKE', "%{$searchTerm}%");
            }
        
            // Menyusun DataTables
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $editUrl = route('menu.view.update', Crypt::encrypt($row->id));
                    $btn = '<a href="'. $editUrl .'" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                    $btn .= '<form action="' . route('delete.menu', Crypt::encrypt($row->id)) . '" method="POST" style="display:inline;" id="delete-form-menu-' . $row->id . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create_menu()  {
        $data = [
            'title' => 'Form Add Menu'
         ];
         return view('Administrator/Menu-Management/Form/Add',$data);
     }

      //code for store data 
      public function store_menu(Request $request)  {
        // Validasi data
      $validatedData = $request->validate([
          'menu' => 'required|string|max:255|alpha|unique:ms_menu',
          // Tambahkan aturan validasi lain jika perlu
      ]);
  
      try {
          // Menginisialisasi model secara langsung
          $menu = new MenuModel(); // Ganti 'Menu' dengan nama model Anda
          $menu->menu = ucwords($validatedData['menu']);
          $menu->save();
  
          // Redirect dengan pesan sukses
          return redirect()->route('menu.view')->with('success', 'Menu created successfully!');
      } catch (\Exception $e) {
          // Tangani kesalahan jika ada masalah saat menyimpan data
          return redirect()->back()->withErrors(['error' => 'Failed to create menu. Please try again.'])->withInput();
      }
       }


       public function view_menu_update($idMenu)  {
        $id = Crypt::decrypt($idMenu);
        $getdatamenu = $this->MenuModel->findOrFail($id);
       $data = [
           'title' => 'Form Edit Menu',
           'menu' => $getdatamenu
        ];
        return view('Administrator/Menu-Management/Form/Edit',$data);
    }


     //code for update
     public function update_menu(Request $request, $id)  {
        // Validasi input
        $validatedData = $request->validate([
           'menu' => 'required|string|max:255|alpha',
           // Tambahkan aturan validasi lain jika perlu
       ]);
   
       // Temukan model yang sesuai
       $menu = $this->MenuModel::findOrFail($id);
       // Perbarui data
       $menu->menu = ucwords($validatedData['menu']);
       $menu->save();
       // Redirect atau beri respons
       return redirect()->route('menu.view')->with('success', 'Data updated successfully!');
    }



    //code for delete
    public function destroy_menu($id) {
        try {
            // Dekripsi ID
            $idMenu = Crypt::decrypt($id);
            // Temukan model yang sesuai
            $menu = $this->MenuModel::findOrFail($idMenu);
            // Hapus data
            $menu->delete();
            // Redirect atau beri respons jika berhasil
            return redirect()->route('menu.view')->with('success', 'Data deleted successfully!');
        } catch (ModelNotFoundException $e) {
            // Model tidak ditemukan
            return redirect()->route('menu.view')->with('error', 'Data not found!');
        } catch (Exception $e) {
            // Kesalahan lainnya
            return redirect()->route('menu.view')->with('error', 'Failed to delete data!');
        }
        }

         //code for restore
     public function restore_menu() {
        $data = [
            'title' => 'Data Menu Restore'
         ];
         return view('Administrator/Menu-Management/Restore/data',$data);
        }

        public function get_menu_data_restore(Request $request)
        {
                if ($request->ajax()) {
                    // Mengambil data dari model dengan join
                    $data = $this->MenuModel->select('*');

                    // Cek apakah ada parameter pencarian
                    if ($request->has('search') && !empty($request->input('search')['value'])) {
                        $searchTerm = $request->input('search')['value'];
                        $data->where('menu', 'LIKE', "%{$searchTerm}%");
                    }
                    // Tampilkan data yang di-soft delete
                    // Ganti dengan `onlyTrashed()` jika ingin hanya data yang dihapus
                    // $data->withTrashed();
                    $data->onlyTrashed();
                    // Menyusun DataTables
                    return DataTables::of($data)
                        ->addIndexColumn()
                        ->addColumn('action', function($row) {
                            $restoreUrl = route('restore.menu', Crypt::encrypt($row->id));
                            $btn = '';

                            $btn .= '<form action="' . $restoreUrl . '" method="POST" style="display:inline;" id="restore-form-menu-' . $row->id . '">
                            ' . csrf_field() . '
                            <button type="submit" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-undo"> Restore Data</i></button>
                            </form>';

                            $btn .= '<form action="' . route('delete.menu.permanent', Crypt::encrypt($row->id)) . '" method="POST" style="display:inline;" id="delete-form-menu-' . $row->id . '">
                                ' . csrf_field() . '
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="button" onclick="confirmDelete(' . $row->id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"> Delete Permanent</i></button>
                                </form>';
                            return $btn;
                        })
                        ->rawColumns(['action'])
                        ->make(true);
                }
}

  // Fungsi untuk mengembalikan data yang di-soft delete
  public function restore($id)
  {
      // Decrypt the ID
      $id = Crypt::decrypt($id);
      // Cari data yang di-soft delete dan restore
      $menu = MenuModel::onlyTrashed()->findOrFail($id);
      $menu->restore();

      // Redirect atau response yang sesuai
      return redirect()->route('menu.view')->with('success', 'Data returned successfully.');
  }


  public function destroy_menu_permanent($id)
    {
        // Decrypt the ID
        $id = Crypt::decrypt($id);
        // Cari data yang dihapus secara soft delete
        $menu = MenuModel::onlyTrashed()->findOrFail($id);
        $menu->forceDelete(); // Hapus data secara permanen
        // Redirect atau response yang sesuai
        return redirect()->route('restore.data.menu')->with('success', 'Data has been successfully deleted permanently.');
    }

// end code for menu module


// start code for  submenu module

public function submenu_management () {
    $data = [
        'title' => 'Management Submenu'
  ];
  return view('Administrator/Submenu-management/Data/file',$data);
}


public function get_submenu_data(Request $request) {
    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->SubmenuModel->select('ms_sub_menu.*','ms_menu.menu')
         ->LeftJoin('ms_menu','ms_sub_menu.menu_id','=','ms_menu.id')
         ->orderby('ms_sub_menu.id', 'DESC');

        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $data->where('title', 'LIKE', "%{$searchTerm}%");
        }
        

        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('menu', function($row) {
                // Misalkan $row->menu adalah nilai yang ingin Anda periksa
                return $row->menu == 'Administrator' ? '<span class="badge badge-success">Administrator</span>' :
                       ($row->menu == 'Admin' ? '<span class="badge badge-warning">Admin</span>' :
                       ($row->menu == 'User' ? '<span class="badge badge-secondary">User</span>' : 
                       ($row->menu == 'Others' ? '<span class="badge badge-info">Others</span>' :'other')));
            })
            ->addColumn('noted', function($row) {
                return '<textarea class="form-control" rows="2" cols="10" readonly>'.$row->noted.'</textarea>';
            })
            ->addColumn('is_active', function($row) {
                return ($row->is_active == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">NonActive</span>');
            })
            ->addColumn('action', function($row) {
                // $editUrl = route('submenu.view', Crypt::encrypt($row->id));
                $btn = '<a href="" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                $btn .= '<form action="" method="POST" style="display:inline;" id="delete-form-menu-' . $row->id . '">
                ' . csrf_field() . '
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" onclick="confirmDelete(' . $row->id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>';
                return $btn;
            })
            ->rawColumns(['menu','is_active','noted','action'])
            ->make(true);
    }
  }


}
