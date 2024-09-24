<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\visitorModel;
use App\Models\PaketModel;

class Home extends Controller
{
    protected $visitorModel;
    protected $PaketModel;
    public function __construct(visitorModel $visitorModel, PaketModel $PaketModel) {
        $this->visitorModel = $visitorModel;
        $this->PaketModel = $PaketModel;
    }

// ------------------------------------------batas-------------------------------------//
// start code untuk visitor
   function Form_visitor()  {
        
         $data  = [
            'title' => 'Visitor Form Registration'
         ];
         return view('home/data/form-visitor',$data);
   }


   public function generateVisitCode()
{
    date_default_timezone_set("Asia/Jakarta");
    $dates = date('ymd'); // Format tanggal saat ini
    // Ambil semua data paket yang diterima hari ini
    $query = $this->visitorModel
        ->selectRaw('RIGHT(identity_visitor, 5) as idvisitor, DATE(created_at) as TanggalVisitor')
        ->whereRaw('DATE(created_at) = ?', [date('Y-m-d')]) // Hanya ambil paket yang diterima hari ini
        ->orderBy('visitor_id', 'DESC')
        ->get();
    // Hitung jumlah paket yang diterima hari ini
    $kode = $query->count() + 1; // Tambahkan 1 untuk kode paket berikutnya
    // Format kode menjadi 5 digit
    $result = sprintf("%05d", $kode);
    // Menghasilkan kode akhir
    $resultscode = $dates . 'VST' . $result;
    return $resultscode;
}

   public function store_data_visit_submission(Request $request)  {
    $VisitCode = $this->generateVisitCode();
   $date = now()->format('Y-m-d');
   $mobil = $request->input('numberVehicles.mobil');
   $motor = $request->input('numberVehicles.motor');
   $lainya = $request->input('numberVehicles.lainya');
   // Cek dan ambil nilai yang ada berdasarkan prioritas
   if (!empty($mobil)) {
    // Jika $mobil ada isinya
    $result = $mobil;
} elseif (!empty($motor)) {
    // Jika $mobil kosong tapi $motor ada isinya
    $result = $motor;
} elseif (!empty($lainya)) {
    // Jika $mobil dan $motor kosong tapi $lainya ada isinya
    $result = $lainya;
} else {
    // Semua input kosong
    $result = null;
}
       $validatedData = $request->validate([
        'name' => 'required|max:250',
        'nohp' => 'required|alpha-dash',
        'company' => 'required',
        'needs' => 'required',
        'meet_with' => 'required',
        'appointment' => 'required',
        'room' => 'required',
        'meet_hour_start' => 'required',
        // 'meet_hour_end' => 'numeric',
    ]);


        // Menginisialisasi model secara langsung
        $visitor = new visitorModel();
        $visitor->identity_visitor = $VisitCode;
        $visitor->date_visitor = $date;
        $visitor->name_visitor = ucwords($validatedData['name']);
        $visitor->no_handphone =$validatedData['nohp'];
        $visitor->company = $validatedData['company'];
        $visitor->number_vehicle = $result;
        $visitor->needs = $validatedData['needs'];
        $visitor->meet_with = $validatedData['meet_with'];
        $visitor->appointment = $validatedData['appointment'];
        $visitor->room = $validatedData['room'];
        $visitor->meet_hour_start = $validatedData['meet_hour_start'];
        $visitor->meet_hour_end = $request->input('meet_hour_end');
        $visitor->save();
        // Redirect dengan pesan sukses
        return redirect()->route('form.visitor')->with('success', 'Data berhasil di submit.');
   }
// end code untuk visitor

// ------------------------------------------batas-------------------------------------//

// start code untuk about
   public function About()  {
    $data  = [
        'title' => 'About US Page'
     ];
     return view('home/data/about',$data);
   }
// end code untuk about

// ------------------------------------------batas-------------------------------------//

// start code untuk pinjam barang
  public  function view_tools_management()  {
    $data  = [
        'title' => 'Tools Management'
     ];
     return view('home/data/tools-view',$data);
   }
// end code untuk pinjam barang


// ------------------------------------------batas-------------------------------------//

// start code untuk cek paket
   public  function check_paket()  {
    $data  = [
        'title' => 'Check Your Paket'
     ];
     return view('home/data/check-paket',$data);
   }


//    code get data paket
public function list_pakets(Request $request) {
    if ($request->ajax()) {
        // Mengambil data dari model dengan join
        $data = $this->PaketModel->select('*')
        ->where('status', 0)
        ->orderBy('id', 'DESC')
        ->get();
    
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
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
                // $editUrl = route('menu.view', Crypt::encrypt($row->id));
                $btn = '<a id="sets" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#actionModal"
                         data-id="' . htmlspecialchars($row->id, ENT_QUOTES, 'UTF-8') . '"
                         data-noidpaket="' . htmlspecialchars($row->noidpaket, ENT_QUOTES, 'UTF-8') . '"
                         data-name="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '">
                        <i class="fa fa-shopping-bag" aria-hidden="true"> </i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}

public function ambil_paket(Request $request) {
    $noPaket = $request->input('noPaket');
     // Melakukan update status
     $paket = $this->PaketModel->where('noidpaket', $noPaket)->first();

     if ($paket) {
         $paket->status = 1; // Mengubah status menjadi 1
         $paket->save(); // Menyimpan perubahan
         return response()->json(['success' => true, 'message' => 'Status berhasil diupdate.']);
     } else {
         return response()->json(['success' => false, 'message' => 'Paket tidak ditemukan.'], 404);
     }
}
// end code untuk cek paket
// ------------------------------------------batas-------------------------------------//


// start code untuk Announcement
public function Announcement() {
    $data  = [
        'title' => 'Announcement'
     ];
     return view('home/data/announcement',$data);
}
// start code untuk Announcement
}
