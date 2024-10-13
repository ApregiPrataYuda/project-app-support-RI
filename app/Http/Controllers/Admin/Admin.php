<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\visitorModel;
use App\Models\PaketModel;
use App\Models\DivisionModel;
use App\Models\MasterItemModel;
use App\Models\TransactionItemModel;
use App\Models\EmployeModel;
use App\Models\subDivisionModel;
use Illuminate\Support\Str;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Termwind\Components\Dd;

class Admin extends Controller
{
    protected $visitorModel;
    protected $PaketModel;
    protected $DivisionModel;
    protected $MasterItemModel;
    protected $TransactionItemModel;
    protected $EmployeModel;
    protected $subDivisionModel;
    public function __construct(EmployeModel $EmployeModel, visitorModel $visitorModel, PaketModel $PaketModel, DivisionModel $DivisionModel, MasterItemModel $MasterItemModel,
     TransactionItemModel $TransactionItemModel, subDivisionModel $subDivisionModel) {
        $this->visitorModel = $visitorModel;
        $this->PaketModel = $PaketModel;
        $this->DivisionModel = $DivisionModel;
        $this->MasterItemModel = $MasterItemModel;
        $this->TransactionItemModel = $TransactionItemModel;
        $this->EmployeModel = $EmployeModel;
        $this->subDivisionModel = $subDivisionModel;
    }

// -----------------------------------------Batas---------------------------------------------------------//

    public  function index() {
        $data = [
            'title' => 'Admin'
         ];
         return view('Admin/Dashboard/Data/file',$data);
    }

// -----------------------------------------Batas---------------------------------------------------------//


//start code for visitor module
    public  function visitors() {
        $data = [
            'title' => 'Data Visitors'
         ];
         return view('Admin/Visitor/Data/file',$data);
    }

    public function get_visitor_data(Request $request) {
        if ($request->ajax()) {
            // Mengambil data dari model dengan join
            $data = $this->visitorModel->select('*');
            // Cek apakah ada parameter pencarian
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                // Pastikan kolom fullname ada di ms_user
                $data->where('identity_visitor', 'LIKE', "%{$searchTerm}%");
            }
            // Menyusun DataTables
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('date_visitor', function($row) {
                    return format_date_indonesia($row->date_visitor);
                })
                ->addColumn('idcard', function ($row) {
                    return '<a href="' . route('idcard.visitor', $row->identity_visitor) . '" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-id-card"></i> ID CARD
                            </a>';
                })
                ->addColumn('detail', function ($row) {
                    return '<a id="sets" class="btn btn-outline-primary btn-sm" data-toggle="modal" 
                                data-target="#modals-detail"
                                >
                                <i class="fa fa-sticky-note"></i>
                            </a>';
                })
                ->addColumn('needs', function($row) {
                    return '<textarea class="form-control" rows="2" cols="10" readonly>'.$row->needs.'</textarea>';
                })
                ->addColumn('number_vehicle', function($row) {
                    return '<textarea class="form-control" rows="2" cols="10" readonly>'.($row->number_vehicle == '' ? 'Tidak Membawa Kendaraan' : $row->number_vehicle).'</textarea>';
                })
                ->addColumn('action', function($row){
                    // $editUrl = route('role.view', Crypt::encrypt($row->role_id));
                    $btn = '<a href="" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                    $btn .= '<form action="" method="POST" style="display:inline;" id="delete-form-menu-' . $row->role_id . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->role_id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>';
                    return $btn;
                })
                ->rawColumns(['idcard','needs','number_vehicle','detail','action'])
                ->make(true);
        }
}

public function idcard_visitor_data ($identity_visitor)  {
       $builders = $this->visitorModel
       ->where('identity_visitor', $identity_visitor)->first();

       $identityVisitor = $builders->identity_visitor;
       $writer = new PngWriter();
       // Create QR code
       $qrCode = QrCode::create($identityVisitor)
           ->setEncoding(new Encoding('UTF-8'))
          //  ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
           ->setSize(300)
           ->setMargin(10)
          //  ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
           ->setForegroundColor(new Color(0, 0, 0))
           ->setBackgroundColor(new Color(255, 255, 255));

       // Create generic logo
          $logo = Logo::create(public_path('logo.png'))
          ->setResizeToWidth(100)
          ->setPunchoutBackground(true);

       // Create generic label
       $label = Label::create('Visitor ID Number')
       ->setTextColor(new Color(255, 0, 0));
       $result = $writer->write($qrCode, $logo, $label);
       $dataUri = $result->getDataUri();


    $data = [
        'title' => 'Print  ID Card Visitors',
        'row' => $builders,
        'dataqr' => $dataUri,
     ];
     return view('Admin/Visitor/Id_card/view_card',$data);
}

function idcard_visitor_data_print ($identity_visitor) {
    $builders = $this->visitorModel
    ->where('identity_visitor', $identity_visitor)->first();

    $identityVisitor = $builders->identity_visitor;
    $writer = new PngWriter();
    // Create QR code
    $qrCode = QrCode::create($identityVisitor)
        ->setEncoding(new Encoding('UTF-8'))
       //  ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(300)
        ->setMargin(10)
       //  ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));

    // Create generic logo
       $logo = Logo::create(public_path('logo.png'))
       ->setResizeToWidth(100)
       ->setPunchoutBackground(true);

    // Create generic label
    $label = Label::create('Visitor ID Number')
    ->setTextColor(new Color(255, 0, 0));
    $result = $writer->write($qrCode, $logo, $label);
    $dataUri = $result->getDataUri();
    $data = [
        'title' => 'Print  ID Card Visitors',
        'row' => $builders,
        'dataqr' => $dataUri,
     ];
    return view('Admin/Visitor/Id_card/print_card',$data);
}



public function Add_visitor()  {
    $data = [
        'title' => 'Tambah Data Visitor'
     ];
     return view('Admin/Visitor/Form/Add',$data);
}



//end code for visitor module

// -----------------------------------------Batas---------------------------------------------------------//

//start code for paket module
public function daftar_paket() {
    $data = [
        'title' => 'Daftar Paket'
     ];
     return view('Admin/Paket/Data/file',$data);
}

//code for get data paket
public function get_paket_data(Request $request) {

    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->PaketModel->select('*')
        ->orderBy('id', 'DESC')
        ->get();
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('name', 'LIKE', "%{$searchTerm}%");
        }
    
        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                return $row->status == 1 ? '<span class="badge badge-pill badge-danger">sudah di ambil</span>' : '<span class="badge badge-pill badge-success">Belum diambil</span>';
            })

            ->addColumn('tanggal_diterima', function($row) {
                    return format_date_indonesia($row->tanggal_diterima);
                })

            ->addColumn('action', function($row){

                if ($row->status == 1) {
                    // Jika status == 1, tidak ada tombol yang ditampilkan
                    return '';
                } else {
                    // Jika status != 1, tampilkan tombol edit dan hapus
                    $editUrl = route('paket.view.data', Crypt::encrypt($row->id));
                    $btn = '<a href="'.$editUrl.'" class="edit btn btn-outline-warning btn-sm mb-1"><i class="fa fa-edit"></i></a>';
                    $btn .= '<form action="' . route('delete.paket', Crypt::encrypt($row->id)) . '" method="POST" style="display:inline;" id="delete-form-paket-' . $row->id . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>';
                    return $btn;
                }
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}


public function generatePaketCode()
{
date_default_timezone_set("Asia/Jakarta");
$dates = date('ymd'); // Format tanggal saat ini
// Ambil semua data paket yang diterima hari ini
$query = $this->PaketModel
    ->selectRaw('RIGHT(noidpaket, 5) as Kodepaket, DATE(tanggal_diterima) as TanggalPaket')
    ->whereRaw('DATE(tanggal_diterima) = ?', [date('Y-m-d')]) // Hanya ambil paket yang diterima hari ini
    ->orderBy('id', 'DESC')
    ->get();
// Hitung jumlah paket yang diterima hari ini
$kode = $query->count() + 1; // Tambahkan 1 untuk kode paket berikutnya
// Format kode menjadi 5 digit
$result = sprintf("%05d", $kode);
// Menghasilkan kode akhir
$resultscode = $dates . 'PKT' . $result;
return $resultscode;
}


public function add_paket ()  {
    $data = [
        'title' => 'Form Paket Add',
     ];
     return view('Admin/Paket/Form/Add',$data);
}


public function store_paket(Request $request) {
    date_default_timezone_set("Asia/Jakarta");
    $timestamp = date('Y-m-d H:i:s');
    $paketCode = $this->generatePaketCode();
    $user_data = getUserData();
    $user_penerima = $user_data->fullname;
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'kurir' => 'required'
    ]);
    try {
        // Menginisialisasi model secara langsung
        $paket = $this->PaketModel;

        $paket->noidpaket = $paketCode;
        $paket->name = ucwords($validatedData['name']);
        $paket->kurir = ucwords($validatedData['kurir']);
        $paket->name_penerima = ucwords($user_penerima);
        $paket->tanggal_diterima = $timestamp;
        $paket->status = 0;
        $paket->save();

        // Redirect dengan pesan sukses
        return redirect()->route('Admin.paket')->with('success', 'Paket Data created successfully!');
    } catch (\Exception $e) {
        // Tangani kesalahan jika ada masalah saat menyimpan data
        return redirect()->back()->withErrors(['error' => 'Failed to Paket Data  Please try again.'])->withInput();
    }
}


public function view_data_paket($id) {
   
    $idpaket = Crypt::decrypt($id);
    $idbypaket = PaketModel::findOrFail($idpaket);
    $data = [
        'title' => 'Form Paket Edit',
        'row' => $idbypaket,
        'idbasic' => $id
     ];
     return view('Admin/Paket/Form/Edit',$data);
}


public function update_paket(Request $request, $id) {

    date_default_timezone_set("Asia/Jakarta");
    $idpaket = Crypt::decrypt($id);
    // Validasi input
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'kurir' => 'required'
    ]);
    // Temukan model yang sesuai
    $paket = $this->PaketModel::findOrFail($idpaket);
    // Perbarui data
        $paket->name = ucwords($validatedData['name']);
        $paket->kurir = ucwords($validatedData['kurir']);
        $paket->save();
    // Redirect atau beri respons
    return redirect()->route('Admin.paket')->with('success', 'Data updated successfully!');
}

public function destroy_paket($id)  {
        // Dekripsi ID
        $idpaket = Crypt::decrypt($id);
        // Temukan model yang sesuai
        $paket = $this->PaketModel::findOrFail($idpaket);
        // Hapus data
        $paket->delete();
        // Redirect atau beri respons jika berhasil
        return redirect()->route('Admin.paket')->with('success', 'Data deleted successfully!');
}

//end code for paket module

// -----------------------------------------Batas---------------------------------------------------------//


//start code for item module
public function Master_item() {
    $data = [
        'title' => 'List Master Item Borrow'
     ];
     return view('Admin/Master-item/Data/file',$data);
}






public function Master_item_add_view ()  {

    $userData = getUserData();
    $divisiID = $userData->employee->divisi->divisi_id;
    $subdivisi = $this->subDivisionModel->where('divisi_id',$divisiID)->get();
   
    $data = [
        'title' => 'Add Master Item Borrow',
        'subdivisi' => $subdivisi
     ];
     return view('Admin/Master-item/Form/Add',$data);
}


public function get_item_data(Request $request) {
    if ($request->ajax()) {
        $userData = getUserData();
    // Memanggil nama divisi
        $divisiID = $userData->employee->divisi->divisi_id;
        // Mengambil data dari model dengan join
        $data = MasterItemModel::select('item_master_borrow.*','ms_divisi.divisi_name','ms_subdivision.subdivision_name')
        ->leftJoin('ms_divisi','item_master_borrow.divisi_id', '=', 'ms_divisi.divisi_id')
        ->leftJoin('ms_subdivision','item_master_borrow.id_subdivision', '=', 'ms_subdivision.id_subdivision')
        ->where('item_master_borrow.divisi_id',$divisiID)
        ->orderBy('item_master_borrow.item_id', 'desc')
        ->get();
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('name_item', 'LIKE', "%{$searchTerm}%");
        }
    
        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('item_code', function($row) {
                $qrcode = route('qr.generate.item', $row->item_code);
                $downloadqr = route('qr.download.item', $row->item_code);
                return '<a href="'.$qrcode.'" class="btn btn-outline-secondary btn-xs mb-2"><i class="fa fa-qrcode" aria-hidden="true"></i> Generate '.$row->item_code.'</a>
                        <a href="'.$downloadqr.'" class="btn btn-outline-danger btn-xs"><i class="fa fa fa-qrcode" aria-hidden="true"></i> Download '.$row->item_code.'</a>';
            })

            ->addColumn('status', function($row) {
                return $row->status == 1 ? '<span class="badge badge-pill badge-danger">ACTIVE</span>' : '<span class="badge badge-pill badge-secondary">NOT ACTIVE</span>';
            })

            ->addColumn('name_item', function($row) {
                return $row->name_item .' - '. $row->item_code;
            })

            ->addColumn('status_borrows', function($row) {
                return $row->status_borrows == 1 ? '<span class="badge badge-danger">Sedang Di pinjam</span>' : '<span class="badge badge-success">Sedang tidak pinjam</span>';
            })

            ->addColumn('description', function($row) {
                return '<textarea  rows="2" cols="10" class="form-control" readonly>'.$row->description.'</textarea>';
            })
            ->addColumn('action', function($row){

                if ($row->status_borrows == 1) {
                    // Jika status == 1, tidak ada tombol yang ditampilkan
                    return '';
                } else {
                    // Jika status != 1, tampilkan tombol edit dan hapus
                    $editUrl = route('edit.item', Crypt::encrypt($row->item_id));
                    $btn = '<a href="'.$editUrl.'" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                    $btn .= '<form action="' . route('delete.item', Crypt::encrypt($row->item_id)) . '" method="POST" style="display:inline;" id="delete-form-item-' . $row->item_id . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->item_id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>';
                    return $btn;
                }
            })
            ->rawColumns(['name_item','item_code','description','status_borrows','status','action'])
            ->make(true);
    }
}


// Misalkan ini adalah metode dalam controller
public function generateCode()
{
    $userData = getUserData();
    // Memanggil nama divisi
    $divisiName = $userData->employee->divisi->divisi_alias;
   // Mengambil ID terakhir yang ada di tabel
   $lastItem = MasterItemModel::orderBy('item_id', 'DESC')->first(); // Mengambil baris terakhir berdasarkan ID

   // Memeriksa apakah ada item yang ditemukan
   if ($lastItem) {
       // Mengambil 3 digit terakhir dari ID dan menambahkan 1
       $kode = intval(substr($lastItem->item_id, -3)) + 1; // Mengambil 3 digit terakhir dari 'id' dan menambah 1
   } else {
       $kode = 1; // Jika tidak ada item, mulai dari 1
   }

   $prefix = Str::random(3);
   $randomNumber = rand(1000, 9999);
   $code = strtoupper($prefix) . $randomNumber;
   
   // Memformat kode menjadi tiga digit dengan nol di depan
   $kodeTampil = str_pad($kode, 5, "0", STR_PAD_LEFT);
   $combined = 'CODE' .$divisiName. $code; // Menggabungkan 'K' dengan kode yang diformat
   return $combined; // Mengembalikan kode akhir
}


public function download_qr_item ($code_item)  {
    // Tentukan lokasi file QR code (misalnya di folder 'storage/app/qr_codes/')
    $filePath = storage_path('app/qr_codes/' . $code_item . '.png');
    
    // Cek apakah file ada
    if (file_exists($filePath)) {
        // Mengembalikan response download
        return response()->download($filePath, $code_item . '.png', [
            'Content-Type' => 'image/png',
        ]);
    } else {
        // Kembalikan response jika file tidak ditemukan
        return redirect()->back()->with('error', 'QR code not found.');
    }
}




   
public function store_item(Request $request) {
    $ItemCode = $this->generateCode();
    //get seesion
    $userData = getUserData();
    // Memanggil  divisi
    $divisiID = $userData->employee->divisi->divisi_id;
    $validatedData = $request->validate([
        'name_item' => 'required|max:255',
        'sub_division' => 'required'
    ]);

    // Cek apakah qr_item sudah ada
    if (MasterItemModel::where('item_code', $ItemCode)->exists()) {
        return response()->json(['error' => 'code Item sudah ada.'], 409); // Kode 409 untuk konflik
    }

    try {
        // Menginisialisasi model secara langsung
        $Item = new MasterItemModel();
        $Item->item_code = $ItemCode;
        $Item->name_item = ucwords($validatedData['name_item']);
        $Item->divisi_id = $divisiID;
        $Item->id_subdivision = $validatedData['sub_division'];
        $Item->description = $request->input('description');
        $Item->status = 1;
        $Item->status_borrows = 0;
        $Item->save();

        // Redirect dengan pesan sukses
        return redirect()->route('item.master')->with('success', 'Master Data Item created successfully!');
    } catch (\Exception $e) {
        // Tangani kesalahan jika ada masalah saat menyimpan data
        return redirect()->back()->withErrors(['error' => 'Failed to Item Data  Please try again.'])->withInput();
    }
}

public function generate_qr_item($code_item) {

    //get seesion
    $userData = getUserData();
    // Memanggil  divisi
    $divisi_alias = $userData->employee->divisi->divisi_alias;

    $builders = $this->MasterItemModel
    ->where('item_code', $code_item)->first();
    $code_item = $builders->item_code;
    $name_item = $builders->name_item;
    $writer = new PngWriter();
    // Create QR code
     $qrCode = QrCode::create($code_item)
        ->setEncoding(new Encoding('UTF-8'))
       //  ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(300)
        ->setMargin(10)
       //  ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));
    // Create generic logo
       $logo = Logo::create(public_path('rinnai.png'))
       ->setResizeToWidth(80)
       ->setPunchoutBackground(true);
    // Create generic label
    $label = Label::create($name_item)
        ->setTextColor(new Color(255, 0, 0));
         // Adjust the size as needed

    $result = $writer->write($qrCode, $logo, $label);
    // Define the file path in the storage folder
    $filePath = storage_path('app/qr_codes/' . $code_item . '.png');
    if (!file_exists(storage_path('app/qr_codes'))) {
        mkdir(storage_path('app/qr_codes'), 0755, true);
    }
    $result->saveToFile($filePath);
    $dataUri = $result->getDataUri();
    return redirect()->route('item.master')->with('success', 'QR CODE SUCCESS CREATED!');
  
    // $data = [
    //     'title' => 'Print QR-iTEM',
    //     'qr' => $dataUri
    //  ];
    //  return view('Admin/Master-item/QR/file',$data);
}




public function Master_item_edit_view ($id) {
    $iditem = Crypt::decrypt($id);
    $getdataitem = $this->MasterItemModel->findOrFail($iditem);
    $userData = getUserData();
    $divisiID = $userData->employee->divisi->divisi_id;
    $subdivisi = $this->subDivisionModel->where('divisi_id',$divisiID)->get();
    $data = [
        'title' => 'Edit Master Item Borrow',
        'basicId' => $id,
        'item' => $getdataitem,
        'subdivisi' => $subdivisi
     ];
     return view('Admin/Master-item/Form/Edit',$data);
}



public function update_item(Request $request, $id) {
    $iditem = Crypt::decrypt($id);
    // Validasi input
    $validatedData = $request->validate([
        'name_item' => 'required|max:255', 
        'sub_division' => 'required'
    ]);
    // Temukan model yang sesuai
    $Item = $this->MasterItemModel::findOrFail($iditem);
    // Perbarui data
    $Item->name_item = ucwords($validatedData['name_item']);
    $Item->id_subdivision = $validatedData['sub_division'];
    $Item->description = $request->input('description');
    $Item->status = $request->input('status');
    $Item->save();
    // Redirect atau beri respons
    return redirect()->route('item.master')->with('success', 'Data updated successfully!');
}


public function destroy_item($id)  {
    // Dekripsi ID
    $iditem = Crypt::decrypt($id);
    // Temukan model yang sesuai
    $paket = $this->MasterItemModel::findOrFail($iditem);
    // Hapus data
    $paket->delete();
    // Redirect atau beri respons jika berhasil
    return redirect()->route('item.master')->with('success', 'Data deleted successfully!');
}


public function Restore_item() {
    $data = [
        'title' => 'Restore Data'
     ];
     return view('Admin/Master-item/Restore/Data',$data);
}

public function get_item_data_restore(Request $request) {
    if ($request->ajax()) {
        $userData = getUserData();
    // Memanggil nama divisi
        $divisiID = $userData->employee->divisi->divisi_id;
        // Mengambil data dari model dengan join
        $data = MasterItemModel::select('item_master_borrow.*','ms_divisi.divisi_name')
        ->leftJoin('ms_divisi','item_master_borrow.divisi_id', '=', 'ms_divisi.divisi_id')
        ->where('item_master_borrow.divisi_id',$divisiID)
        ->onlyTrashed();

        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('name_item', 'LIKE', "%{$searchTerm}%");
        }

        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()

            ->addColumn('status', function($row) {
                return $row->status == 1 ? '<span class="badge badge-pill badge-danger">ACTIVE</span>' : '<span class="badge badge-pill badge-secondary">NOT ACTIVE</span>';
            })

            ->addColumn('name_item', function($row) {
                return $row->name_item .' - '. $row->item_code;
            })

            ->addColumn('status_borrows', function($row) {
                return $row->status_borrows == 1 ? '<span class="badge badge-danger">Sedang Di pinjam</span>' : '<span class="badge badge-success">Sedang tidak dipinjam</span>';
            })

            ->addColumn('description', function($row) {
                return '<textarea  rows="2" cols="10" class="form-control" readonly>'.$row->description.'</textarea>';
            })
            ->addColumn('action', function($row) {
                $restoreUrl = route('restore.item', Crypt::encrypt($row->item_id));
                $btn = '';
                $btn .= '<form action="' . $restoreUrl . '" method="POST" style="display:inline;" id="restore-form-menu-' . $row->item_id . '">
                ' . csrf_field() . '
                <button type="submit" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-undo"> Restore Data</i></button>
                </form>';
                $btn .= '<form action="' . route('delete.item.permanent', Crypt::encrypt($row->item_id)) . '" method="POST" style="display:inline;" id="delete-form-item-' . $row->item_id . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->item_id . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"> Delete Permanent</i></button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['name_item','description','status_borrows','status','action'])
            ->make(true);
    }
}



public function restore_item_data($id)
  {
      // Decrypt the ID
      $id = Crypt::decrypt($id);
      // Cari data yang di-soft delete dan restore
      $menu = MasterItemModel::onlyTrashed()->findOrFail($id);
      $menu->restore();

      // Redirect atau response yang sesuai
      return redirect()->route('item.master')->with('success', 'Data Success Restore.');
  }


  public function destroy_item_permanent($id)
  {
      // Decrypt the ID
      $id = Crypt::decrypt($id);
      // Cari data yang dihapus secara soft delete
      $menu = MasterItemModel::onlyTrashed()->findOrFail($id);
      $menu->forceDelete(); // Hapus data secara permanen
      // Redirect atau response yang sesuai
      return redirect()->route('item.master.restore')->with('success', 'Data has been successfully deleted permanently.');
  }



//end code for item module

// -----------------------------------------Batas---------------------------------------------------------//

//start code for transaction item module

public function Transaction_item () {
    $data = [
        'title' => 'List Item In Borrow',
     ];
     return view('Admin/Transaction-item/Data/file',$data);
}


public function get_item_trans_data(Request $request)  {
     //get seesion
     $userData = getUserData();
     // Memanggil  divisi
     $divisiID = $userData->employee->divisi->divisi_id;
    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->TransactionItemModel->select('transactions_items_borrow.*','employees.name','ms_divisi.divisi_name', 'item_master_borrow.name_item','ms_subdivision.subdivision_name')
        ->leftJoin('employees','transactions_items_borrow.badgenumber', '=', 'employees.badgenumber')
        ->leftJoin('ms_divisi','employees.divisi_id', '=', 'ms_divisi.divisi_id')
        ->leftJoin('item_master_borrow','transactions_items_borrow.item_code', '=', 'item_master_borrow.item_code')
        ->leftJoin('ms_subdivision','item_master_borrow.id_subdivision','=','ms_subdivision.id_subdivision')
        ->where('item_master_borrow.divisi_id', $divisiID)
        ->orderBy('transactions_items_borrow.borrow_id', 'DESC')
        ->get();
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('item_code', 'LIKE', "%{$searchTerm}%");
        }
        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('name_borrow', function($row) {
                return '<p class="text-uppercase">'.$row->name.'</p>' ;
                })

            ->addColumn('status', function($row) {
                return $row->status == 1 ? '<span class="badge badge-pill badge-danger">Sedang Di Pinjam(digunakan)</span>' : '<span class="badge badge-pill badge-success">Sudah kembali</span>';
            })

            ->addColumn('last_status', function($row) {
                return $row->last_status == 1 ? '<span class="badge badge-pill badge-danger">Belum Di kembalikan</span>' : '<span class="badge badge-pill badge-success">Sudah Di kembalikan</span>';
            })

            ->addColumn('date_borrow', function($row) {
                return format_date_indonesia($row->date_borrow);
                })

            ->addColumn('return_date', function($row) {
                return $row->return_date == null ? '<span class="badge badge-pill badge-danger">Belum ada tanggal pengembalian</span>' : format_date_indonesia($row->return_date);
                })
            ->rawColumns(['name_borrow','status','return_date','last_status'])
            ->make(true);
    }
}
//start code for transaction item module
// -----------------------------------------Batas---------------------------------------------------------//



//start code for  employe module
public function Employe_management()  {
    $data = [
        'title' => 'Employe Data List',
     ];
     return view('Admin/Employe/Data/file',$data);
}



public function get_data_employe(Request $request)  {
     //get seesion
     $userData = getUserData();
     // Memanggil  divisi
     $divisiID = $userData->employee->divisi->divisi_id;
    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->EmployeModel->select('employees.*','ms_divisi.divisi_name','branch_tb.name_alias')
        ->leftJoin('ms_divisi','employees.divisi_id', '=', 'ms_divisi.divisi_id')
        ->leftJoin('branch_tb','employees.branch_id', '=', 'branch_tb.id_branch')
        ->where('employees.divisi_id', $divisiID)
        ->orderBy('id_employee', 'DESC')
        ->get();
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            // Pastikan kolom fullname ada di ms_user
            $data->where('name', 'LIKE', "%{$searchTerm}%");
        }
    
        // Menyusun DataTables
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('gender', function($row) {
                return $row->gender == null ? 'Tidak Diketahui' : $row->gender;
            })
            ->addColumn('status', function($row) {
                return $row->status == 1 ? '<span class="badge badge-pill badge-danger">Aktif</span>' : '<span class="badge badge-pill badge-success">NonAktif</span>';
            })

            ->addColumn('action', function($row){
                    $editUrl = route('employe.view.data', Crypt::encrypt($row->id_employee));
                    $btn = '<a href="'.$editUrl.'" class="edit btn btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                    $btn .= '<form action="' . route('delete.employe', Crypt::encrypt($row->id_employee)) . '" method="POST" style="display:inline;" id="delete-form-employe-' . $row->id_employee . '">
                    ' . csrf_field() . '
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="button" onclick="confirmDelete(' . $row->id_employee . ')" class="edit btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </form>';
                    return $btn;
                
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}


public function add_employe() {
    // $divisi = $this->DivisionModel->all();
    $userData = getUserData();
    $divisiID = $userData->employee->divisi->divisi_id;
    $subdivisi = $this->subDivisionModel->where('divisi_id',$divisiID)->get();
   
    $data = [
        'title' => 'Employe Form Add',
        'subdivisi' => $subdivisi
     ];
     return view('Admin/Employe/Form/Add',$data);
} 


public function getNikByCode($nik)
{
    $badgeNumber = explode('|', $nik);
    $getKodePin = $badgeNumber[2];
    $employe = $this->EmployeModel->where('badgenumber', $getKodePin)
    ->join('ms_divisi', 'employees.divisi_id', '=', 'ms_divisi.divisi_id')
    ->select('employees.*', 'ms_divisi.divisi_name')
    ->first();
    if ($employe) {
        return response()->json([
            'success' => true,
            'name' => $employe->name, 
        ]);
    }
    return response()->json(['success' => false]);
}



public function cek_pin_employe(Request $request) {
    // Validate the request
    $request->validate([
        'nikEmployes' => 'required|string',
    ]);
    // Get the kodeProduct from the request
    $nikEmployes = $request->input('nikEmployes');
    $array = explode('|', $nikEmployes);
    $lastResult = $array[2];
    // Remove empty elements if necessary
    // $array = array_filter($array);
    // print_r($array);
    // Check if the product code exists
    $exists = EmployeModel::where('badgenumber', $lastResult)->exists();
    // Return a JSON response
    return response()->json(['exists' => $exists]);
}





public function store_employe(Request $request)  {
      // Ambil session data
    $userData = getUserData();
    // Mendapatkan divisi dan branch dari session user
    $divisiID = $userData->employee->divisi->divisi_id;
    $branchID = $userData->employee->branch->id_branch;

    // Mengambil dan memisahkan input NIK Employees
    $name = $request->input('name');
    
    $array = explode('|', $nikEmployes);
    $badgenumber = $array[2];
    $ssn = $array[3];
    $ssn_x = $array[4];
    
    // Validasi input yang diterima
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'gender' => 'nullable|string|max:50',
        'title' => 'nullable|string|max:255',
        'pager' => 'nullable|string|max:255',
        'street' => 'nullable|string|max:255',
        'status' => 'nullable|string|max:50',
    ]);

    try {
        // Mencari data employee berdasarkan ID
        // $employee = EmployeModel::findOrFail($badgenumber);
        $employee = EmployeModel::where('badgenumber', $badgenumber)->firstOrFail();
        // dd($employee);
        // Update data employee dengan input yang baru
        // $employee->badgenumber = $badgenumber;
        // $employee->ssn = $ssn;
        // $employee->ssn_x = $ssn_x;
        $employee->name = $name;
        $employee->gender = $validatedData['gender'];
        $employee->divisi_id = $divisiID;
        $employee->branch_id = $branchID;
        $employee->title = $validatedData['title'];
        $employee->pager = $validatedData['pager'];
        $employee->street = $validatedData['street'];
        $employee->status = $validatedData['status'];
        
        // Simpan perubahan ke database
        $employee->save();

        // Kembalikan respons sukses
        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.']);
    } catch (\Exception $e) {
        // Kembalikan respons jika ada kesalahan
        return response()->json(['success' => false, 'message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
    }
    }

        public function destroy_employe ($id)  {
        // Dekripsi ID
        $idemp = Crypt::decrypt($id);
        // Temukan model yang sesuai
        $paket = $this->EmployeModel::findOrFail($idemp);
        // Hapus data
        $paket->delete();
        // Redirect atau beri respons jika berhasil
        return redirect()->route('Admin.Employe.List')->with('success', 'Data deleted successfully!');
        }




        public function view_data_employe($id)  {

            $userData = getUserData();
            $divisiID = $userData->employee->divisi->divisi_id;
            $subdivisi = $this->subDivisionModel->where('divisi_id',$divisiID)->get();
            $idemp = Crypt::decrypt($id);
            $getdataemp = $this->EmployeModel->findOrFail($idemp);
           
            $data = [
                'title' => 'Employe Form Edit',
                'subdivisi' => $subdivisi,
                'emp' => $getdataemp,
                'basicid' => $id
             ];
             return view('Admin/Employe/Form/Edit',$data);
        }


        public function update_employe (Request $request, $id)  {
            $idemp = Crypt::decrypt($id);
            // Validasi data yang diterima
        $validatedData = $request->validate([
            // 'nikEmployes' => 'required|string|max:255',
            'name' => 'required|max:255',
            'gender' => 'required|max:255',
            'title' => 'nullable|string|max:255',
            'pager' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:50',
        ]);

        $Employe = $this->EmployeModel::findOrFail($idemp);
        // Perbarui data
        $Employe->name = ucwords($validatedData['name']);
        $Employe->gender = ucwords($validatedData['gender']);
        $Employe->title = $request->input('title');
        $Employe->pager = $request->input('pager');
        $Employe->street = $request->input('street');
        $Employe->status = $request->input('status');
        $Employe->save();
        // Redirect atau beri respons
        return redirect()->route('Admin.Employe.List')->with('success', 'Data updated successfully!');
        }


  //end code for  employe module

// -----------------------------------------Batas---------------------------------------------------------//

}
