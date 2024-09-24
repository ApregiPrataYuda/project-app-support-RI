<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\SubmenuModel;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\AccessMenuModel;
use App\Models\AccesssubMenuModel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\Redirect;


class Administrator extends Controller
{
     protected $MenuModel;
     protected $SubmenuModel;
     protected $RoleModel;
     protected $AccessMenuModel;
     protected $UserModel;
     protected $AccesssubMenuModel;
    public function __construct(MenuModel $MenuModel, SubmenuModel $SubmenuModel, RoleModel $RoleModel, AccessMenuModel $AccessMenuModel, UserModel $UserModel, AccesssubMenuModel $AccesssubMenuModel) {
        $this->MenuModel = $MenuModel;
        $this->SubmenuModel = $SubmenuModel;
        $this->RoleModel = $RoleModel;
        $this->AccessMenuModel = $AccessMenuModel;
        $this->UserModel = $UserModel;
        $this->AccesssubMenuModel = $AccesssubMenuModel;
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
                return $row->menu == 'Administrator' ? '<span class="badge badge-pill badge-success">Administrator</span>' :
                       ($row->menu == 'Admin' ? '<span class="badge badge-pill badge-warning">Admin</span>' :
                       ($row->menu == 'User' ? '<span class="badge badge-pill badge-secondary">User</span>' : 
                       ($row->menu == 'Others' ? '<span class="badge badge-pill badge-info">Others</span>' :'other')));
            })
            ->addColumn('noted', function($row) {
                return '<textarea class="form-control" rows="2" cols="10" readonly>'.$row->noted.'</textarea>';
            })
            ->addColumn('is_active', function($row) {
                return ($row->is_active == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">NonActive</span>');
            })
            ->addColumn('action', function($row) {
                $editUrl = route('submenu.view.update', Crypt::encrypt($row->id));
                $btn = '<a href="'.$editUrl.'" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                $btn .= '<form action="' . route('delete.submenu', Crypt::encrypt($row->id)) . '" method="POST" style="display:inline;" id="delete-form-menu-' . $row->id . '">
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


  public function create_submenu() {
    $getdatamenu = $this->MenuModel->all();
    $data = [
         'title' => 'Form Add Submenu',
         'menu' => $getdatamenu
    ];
    return view('Administrator/Submenu-management/Form/Add',$data);
  }


  public function store_submenu(Request $request) {
    $validatedData = $request->validate([
        'title' => 'required|string|max:50|unique:ms_sub_menu',
        'menu_id' => 'required',
        'url' => 'required|string|max:255|unique:ms_sub_menu',
        'icon' => 'required',
        'status' => 'required',
        'status' => 'required',
        'noted' => 'required',
        // Tambahkan aturan validasi lain jika perlu
    ]);

    try {
        // Menginisialisasi model secara langsung
        $submenu = new SubmenuModel();
        $submenu->menu_id = $validatedData['menu_id'];
        $submenu->title = ucwords($validatedData['title']);
        $submenu->url = $validatedData['url'];
        $submenu->icon = $validatedData['icon'];
        $submenu->is_active = $validatedData['status'];
        $submenu->noted = $validatedData['noted'];
    
        $submenu->save();
        // Redirect dengan pesan sukses
        return redirect()->route('submenu.view')->with('success', 'SubMenu created successfully!');
    } catch (\Exception $e) {
        // Tangani kesalahan jika ada masalah saat menyimpan data
        return redirect()->back()->withErrors(['error' => 'Failed to create menu. Please try again.'])->withInput();
    }
  }


  public function view_submenu_update ($id)  {
    $getdatamenu = $this->MenuModel->all();
    $idsubmenu = Crypt::decrypt($id);
    $gtedatasubmenu= SubmenuModel::findOrFail($idsubmenu);
    $getIdEncrypt = $id;
    $data = [
        'title' => 'Form Edit Submenu',
        'menu' => $getdatamenu,
        'submenu' => $gtedatasubmenu,
        'idencysubmenu' => $getIdEncrypt
   ];
   return view('Administrator/Submenu-management/Form/Edit',$data);
  }


  public function update_submenu (Request $request, $id)  {
    $title = $request->input('title'); 
    $url = $request->input('url'); 
    $idsubmenu = Crypt::decrypt($id);
    try {
        // Validasi input
        $validatedData = $request->validate([
            'title' => 'required|max:250',
            'menu_id' => 'required',
            'url' => 'required|max:255',
            'icon' => 'required',
            'status' => 'required',
            'noted' => 'required',
            // Tambahkan aturan validasi lain jika perlu
        ]);

         // Cek apakah submenu title dengan nama yang sama sudah ada
    if ($this->SubmenuModel->checksubmenu($title, $idsubmenu) > 0) {
        // Simpan pesan flash ke session
        Session::flash('message', "Title submenu, {$title} Sudah digunakan");
        return Redirect::route('submenu.view');
    }

    // Cek apakah submenu dengan nama yang sama sudah ada
    if ($this->SubmenuModel->checksubmenuurl($url, $idsubmenu) > 0) {
        // Simpan pesan flash ke session
        Session::flash('message', "URL submenu, {$title} Sudah digunakan");
        return Redirect::route('submenu.view');
    }



        // Temukan model yang sesuai
        $submenu = $this->SubmenuModel::findOrFail($idsubmenu);
        // Perbarui data
        $submenu->menu_id = $validatedData['menu_id'];
        $submenu->title = ucwords($validatedData['title']);
        $submenu->url = $validatedData['url'];
        $submenu->icon = $validatedData['icon'];
        $submenu->is_active = $validatedData['status'];
        $submenu->noted = $validatedData['noted'];
        $submenu->save();
        // Redirect atau beri respons jika berhasil
        return redirect()->route('submenu.view')->with('success', 'Data updated successfully!');
    } catch (ModelNotFoundException $e) {
        // Model tidak ditemukan
        return redirect()->route('submenu.view')->with('error', 'submenu not found!');
    } catch (Exception $e) {
        // Kesalahan lainnya
        return redirect()->route('submenu.view')->with('error', 'Failed to update data!');
    }
  }



  public function destroy_submenu($id) {
       
    try {
        // Dekripsi ID
        $idsubmenu = Crypt::decrypt($id);
        // Temukan model yang sesuai
        $role = $this->SubmenuModel::findOrFail($idsubmenu);
        // Hapus data
        $role->delete();

        // Redirect atau beri respons jika berhasil
        return redirect()->route('submenu.view')->with('success', 'Data deleted successfully!');
    } catch (ModelNotFoundException $e) {
        // Model tidak ditemukan
        return redirect()->route('submenu.view')->with('error', 'Data not found!');
    } catch (Exception $e) {
        // Kesalahan lainnya
        return redirect()->route('submenu.view')->with('error', 'Failed to delete data!');
    }
  }


  public function restore_submenu() {
    $data = [
        'title' => 'Data submenu Restore',
     ];
     return view('Administrator/Submenu-management/Restore/data',$data);
  }


  public function get_submenu_data_restore(Request $request) {
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
        // Tampilkan data yang di-soft delete
        // Ganti dengan `onlyTrashed()` jika ingin hanya data yang dihapus
        // $data->withTrashed();
        $data->onlyTrashed();

        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('menu', function($row) {
                // Misalkan $row->menu adalah nilai yang ingin Anda periksa
                return $row->menu == 'Administrator' ? '<span class="badge badge-success">Administrator</span>' :
                       ($row->menu == 'Admin' ? '<span class="badge badge-warning">Admin</span>' :
                       ($row->menu == 'User' ? '<span class="badge badge-secondary">User</span>' : 'other'));
                      
            })
            ->addColumn('is_active', function($row) {
                return ($row->is_active == 1 ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-danger">NonActive</span>');
            })
            ->addColumn('noted', function($row) {
                return '<textarea class="form-control" rows="2" cols="10" readonly>'.$row->noted.'</textarea>';
            })
            ->addColumn('action', function($row) {
                $restoreUrl = route('restore.submenu', Crypt::encrypt($row->id));
                $btn = '';
                $btn .= '<form action="' . $restoreUrl . '" method="POST" style="display:inline;" id="restore-form-menu-' . $row->id . '">
                ' . csrf_field() . '
                <button type="submit" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-undo"> Restore Data</i></button>
                </form>';

                $btn .= '<form action="' . route('delete.submenu.permanent', Crypt::encrypt($row->id)) . '" method="POST" style="display:inline;" id="delete-form-menu-' . $row->id . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"> Delete Permanent</i></button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['is_active','menu','noted','action'])
            ->make(true);
    }
  }


public function restore_submenu_data ($id) {
    // Decrypt the ID
  $id = Crypt::decrypt($id);
  // Cari data yang di-soft delete dan restore
  $submenu = submenuModel::onlyTrashed()->findOrFail($id);
  $submenu->restore();

  // Redirect atau response yang sesuai
  return redirect()->route('submenu.view')->with('success', 'Data returned successfully.');
  }



  public function destroy_submenu_permanent ($id) {
     // Decrypt the ID
        $id = Crypt::decrypt($id);
        // Cari data yang dihapus secara soft delete
        $submenu = submenuModel::onlyTrashed()->findOrFail($id);
        $submenu->forceDelete(); // Hapus data secara permanen
        // Redirect atau response yang sesuai
        return redirect()->route('restore.data.submenu')->with('success', 'Data has been successfully deleted permanently.');
  }


//   start code for role module

public function Role_management ()  {
    $data = [
        'title' => 'Data Role Management'
     ];
     return view('Administrator/Role-management/Data/file',$data);
}

public function get_role_data(Request $request)  {
    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->RoleModel->select('*');
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('menu', 'LIKE', "%{$searchTerm}%");
        }
    
        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('access', function($row) {
                $urlAccess = route('menu.access', Crypt::encrypt($row->role_id));
                return '<a href="'.$urlAccess.'" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i> Access To Menu</a>';
            })

            ->addColumn('action', function($row){
                $editUrl = route('role.view', Crypt::encrypt($row->role_id));
                $btn = '<a href="'.$editUrl.'" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                $btn .= '<form action="' . route('delete.role', Crypt::encrypt($row->role_id)) . '" method="POST" style="display:inline;" id="delete-form-menu-' . $row->role_id . '">
                ' . csrf_field() . '
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" onclick="confirmDelete(' . $row->role_id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>';
                return $btn;
            })
            ->rawColumns(['access','action'])
            ->make(true);
    }
  }


  public function create_role()  {
    $data = [
        'title' => 'Form Add Role',
     ];
     return view('Administrator/Role-management/Form/Add',$data);
  }


public function store_role(Request $request)  {
      // Validasi data
$validatedData = $request->validate([
    'role' => 'required|string|max:255|unique:ms_role',
    // Tambahkan aturan validasi lain jika perlu
]);

try {
    // Menginisialisasi model secara langsung
    $menu = new RoleModel(); // Ganti 'Menu' dengan nama model Anda
    $menu->role = ucwords($validatedData['role']);
    $menu->save();
    // Redirect dengan pesan sukses
    return redirect()->route('role.index')->with('success', 'Role created successfully!');
} catch (\Exception $e) {
    // Tangani kesalahan jika ada masalah saat menyimpan data
    return redirect()->back()->withErrors(['error' => 'Failed to create role. Please try again.'])->withInput();
}
  }


  public function view_role(Request $request, $id)  {
    $idRole = Crypt::decrypt($id);
    $getdatarole = $this->RoleModel->findOrFail($idRole);
    $data = [
        'title' => 'Form Edit Role',
        'role' => $getdatarole,
        'idbasic' => $id
     ];
     return view('Administrator/Role-management/Form/Edit',$data);
  }


 public function update_role(Request $request, $id)  {
    $idRole = Crypt::decrypt($id);
    try {
        // Validasi input
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
            // Tambahkan aturan validasi lain jika perlu
        ]);

        // Temukan model yang sesuai
        $role = $this->RoleModel::findOrFail($idRole);

        // Perbarui data
        $role->role = ucwords($validatedData['role']);
        $role->save();

        // Redirect atau beri respons jika berhasil
        return redirect()->route('role.index')->with('success', 'Data updated successfully!');
    } catch (ModelNotFoundException $e) {
        // Model tidak ditemukan
        return redirect()->route('role.index')->with('error', 'Role not found!');
    } catch (Exception $e) {
        // Kesalahan lainnya
        return redirect()->route('role.index')->with('error', 'Failed to update data!');
    }
}



public function destroy_role($id)  {
    try {
        // Dekripsi ID
        $idRole = Crypt::decrypt($id);
        // Temukan model yang sesuai
        $role = $this->RoleModel::findOrFail($idRole);
        // Hapus data
        $role->delete();

        // Redirect atau beri respons jika berhasil
        return redirect()->route('role.index')->with('success', 'Data deleted successfully!');
    } catch (ModelNotFoundException $e) {
        // Model tidak ditemukan
        return redirect()->route('role.index')->with('error', 'Data not found!');
    } catch (Exception $e) {
        // Kesalahan lainnya
        return redirect()->route('role.index')->with('error', 'Failed to delete data!');
    }
}

public function restore_role() {
    $data = [
        'title' => 'Data Role Restore',
     ];
     return view('Administrator/Role-management/Restore/data',$data);
    }

    public function get_role_data_restore(Request $request)  {
        if ($request->ajax()) {
            // Mengambil data dari model dengan join
            $data = $this->RoleModel->select('*');

            // Cek apakah ada parameter pencarian
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                $data->where('role', 'LIKE', "%{$searchTerm}%");
            }
            // Tampilkan data yang di-soft delete
            // Ganti dengan `onlyTrashed()` jika ingin hanya data yang dihapus
            // $data->withTrashed();
            $data->onlyTrashed();

            // Menyusun DataTables
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $restoreUrl = route('restore.role', Crypt::encrypt($row->role_id));
                    $btn = '';
                    $btn .= '<form action="' . $restoreUrl . '" method="POST" style="display:inline;" id="restore-form-menu-' . $row->role_id . '">
                    ' . csrf_field() . '
                    <button type="submit" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-undo"> Restore Data</i></button>
                    </form>';

                    $btn .= '<form action="' . route('delete.role.permanent', Crypt::encrypt($row->role_id)) . '" method="POST" style="display:inline;" id="delete-form-menu-' . $row->role_id . '">
                        ' . csrf_field() . '
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" onclick="confirmDelete(' . $row->role_id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"> Delete Permanent</i></button>
                        </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    // Fungsi untuk mengembalikan data yang di-soft delete
  public function restore_role_data($id)
  {
      // Decrypt the ID
      $id = Crypt::decrypt($id);
      // Cari data yang di-soft delete dan restore
      $menu = RoleModel::onlyTrashed()->findOrFail($id);
      $menu->restore();

      // Redirect atau response yang sesuai
      return redirect()->route('role.index')->with('success', 'Data returned successfully.');
  }



  public function destroy_role_permanent($id) {
    // Decrypt the ID
    $id = Crypt::decrypt($id);
    // Cari data yang dihapus secara soft delete
    $menu = RoleModel::onlyTrashed()->findOrFail($id);
    $menu->forceDelete(); // Hapus data secara permanen
    // Redirect atau response yang sesuai
    return redirect()->route('restore.data.role')->with('success', 'Data has been successfully deleted permanently.');
  }



  public function access_menu($id) {

    // Decrypt the ID
    $idrole = Crypt::decrypt($id);

    // Retrieve all menu items
    $getdatamenu = MenuModel::all();
    $getroleid = RoleModel::findOrFail($idrole);
 
    // Prepare the data to pass to the view
    $data = [
        'title' => 'Access Role',
        'menu' => $getdatamenu, // Pass menu data to the view
        'roles' => $getroleid // Pass menu data to the view
    ];
     return view('Administrator/Role-management/Access/data',$data);
  }



  public function ubahAccessmenu(Request $request)  {
     // Ambil input dari request
     $menuId = $request->input('menuId');
     $roleId = $request->input('roleId');

     // Siapkan data untuk query
     $data = [
         'role_id' => $roleId,
         'menu_id' => $menuId
     ];

     // Cek apakah data sudah ada di database
     $exists = $this->AccessMenuModel
         ->where($data)
         ->exists();

     if (!$exists) {
         // Jika tidak ada, lakukan insert
         $this->AccessMenuModel->insert($data);
         Session::flash('success', 'Access Changed');
     } else {
         // Jika ada, lakukan delete
         $this->AccessMenuModel->where($data)->delete();
         Session::flash('success', 'Access Changed');
     }

     // Kembalikan response JSON atau redirect sesuai kebutuhan
     return response()->json(['success' => true]);
  }

//   end code for role module



public function Manajemen_pengguna()  {
    $data = [
        'title' => 'Manajemen Pengguna'
     ];
     return view('Administrator/Manajemen-Pengguna/Data/file',$data);
}

public function get_user_data(Request $request) {
    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->UserModel->select('ms_user.user_id','ms_user.fullname','ms_user.username', 'ms_user.image','ms_user.password','ms_user.is_active', 'ms_user.email', 'ms_role.role')
            ->leftJoin('ms_role', 'ms_user.role_id', '=', 'ms_role.role_id');
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('ms_user.fullname', 'LIKE', "%{$searchTerm}%")
                 ->orWhere('ms_user.username', 'LIKE', "%{$searchTerm}%")
                 ->orWhere('ms_user.email', 'LIKE', "%{$searchTerm}%");  // Tambahkan kolom lain jika perlu
        }
    
        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function($row) {
                $imageUrl = asset('assets/backend/dist/img/avatar/' . $row->image); // Sesuaikan dengan path penyimpanan Anda
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })
           
            ->addColumn('access', function($row) {
                $urlAccess = route('user.access', Crypt::encrypt($row->user_id));
                return '<a href="'.$urlAccess.'" class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></a>';
            })
            ->addColumn('detail', function ($row) {
                return '<a id="sets" class="btn btn-outline-primary btn-sm" data-toggle="modal" 
                            data-target="#modals-detail"
                            data-fullname="' . htmlspecialchars($row->fullname, ENT_QUOTES, 'UTF-8') . '"
                            data-username="' . htmlspecialchars($row->username, ENT_QUOTES, 'UTF-8') . '"
                            data-password="' . htmlspecialchars($row->password, ENT_QUOTES, 'UTF-8') . '"
                            data-email="' . htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8') . '"
                            data-role="' . htmlspecialchars($row->role, ENT_QUOTES, 'UTF-8') . '"
                            data-status="' . ($row->is_active === 1 ? 'Aktif' : 'NonAktif') . '"
                            >
                            <i class="fa fa-sticky-note"></i>
                        </a>';
            })
            ->addColumn('action', function($row){
                $editUrl = route('user.edit', Crypt::encrypt($row->user_id));
                $btn = '<a href="'.$editUrl.'" class="edit btn btn-outline-warning btn-sm mb-1"><i class="fa fa-edit"></i></a>';
                $btn .= '<form action="' . route('delete.user', Crypt::encrypt($row->user_id)) . '" method="POST" style="display:inline;" id="delete-form-' . $row->user_id . '">
                ' . csrf_field() . '
                <input type="hidden" name="_method" value="DELETE">
                <button type="button" onclick="confirmDelete(' . $row->user_id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                </form>';
                return $btn;
            })
            ->rawColumns(['image', 'detail', 'access', 'action'])
            ->make(true);
    }
}


public function access_user($id)  {
    $id_user = Crypt::decrypt($id);
    $getdatasubmenu = $this->SubmenuModel
    ->select('ms_sub_menu.*', 'ms_menu.menu as menu_name')  // Pilih kolom dari tabel submenu dan kolom yang digabungkan
    ->leftJoin('ms_menu', 'ms_sub_menu.menu_id', '=', 'ms_menu.id')
    ->orderby('ms_sub_menu.id','DESC')  // Gabungkan tabel submenu dengan menu, tampilkan semua data dari submenu
    ->get();

    $getuserbyid = $this->UserModel
            ->where('user_id', $id_user)  // Menambahkan kondisi pencarian berdasarkan ID pengguna
            ->first();

    $data = [
        'title' => 'Manajemen user',
        'submenu' => $getdatasubmenu,
        'userID' =>  $getuserbyid
    ];
    return view('Administrator/Manajemen-Pengguna/Access-user/data',$data);
}


public function ubahAccesssubmenu(Request $request)
{
    // Mendapatkan data dari request
    $submenu = $request->input('submenu');
    $userId = $request->input('userId');
    
    // Menyiapkan data untuk query
    $data = [
        'SubmenuID' => $submenu,
        'UserID' => $userId
    ];
    
    // Cek apakah data ada di tabel
    $exists = $this->AccesssubMenuModel
                ->where($data)
                ->exists();

    if (!$exists) {
        // Jika data tidak ada, lakukan insert
        $this->AccesssubMenuModel->insert($data);
        Session::flash('success', 'Access Changed');
    } else {
        // Jika data sudah ada, lakukan delete
        $this->AccesssubMenuModel->where($data)->delete();
        Session::flash('success', 'Access Changed');
    }

    // Mengembalikan response JSON
    return response()->json(['success' => true]);
}

}
