<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Models\visitorModel;
use App\Models\PaketModel;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class Admin extends Controller
{
    protected $visitorModel;
    protected $PaketModel;
    public function __construct(visitorModel $visitorModel, PaketModel $PaketModel) {
        $this->visitorModel = $visitorModel;
        $this->PaketModel = $PaketModel;
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

}