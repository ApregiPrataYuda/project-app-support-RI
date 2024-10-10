<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use App\Models\visitorModel;
use App\Models\PaketModel;
use App\Models\MasterItemModel;
use App\Models\EmployeModel;
use App\Models\DivisionModel;
use App\Models\TransactionItemModel;
use Illuminate\Support\Facades\Log;


class Home extends Controller
{
    protected $visitorModel;
    protected $PaketModel;
    protected $EmployeModel;
    protected $DivisionModel;
    public function __construct(visitorModel $visitorModel, PaketModel $PaketModel , EmployeModel $EmployeModel, DivisionModel $DivisionModel) {
        $this->visitorModel = $visitorModel;
        $this->PaketModel = $PaketModel;
        $this->EmployeModel = $EmployeModel;
        $this->DivisionModel = $DivisionModel;
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
  public  function view_borrow_management()  {
    $data  = [
        'title' => 'Borrow Items'
     ];
     return view('home/data/borrow-item-view',$data);
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



// start code untuk pinjam item
public function getItemByCode($kode)
{
    // Cari item berdasarkan kode produk
    $item = MasterItemModel::where('item_code', $kode)->first();
    // Cek apakah item ditemukan
    if (!$item) {
        return response()->json([
            'success' => false,
            'message' => 'Item not found'
        ]);
    }
    // Cek apakah status_borrow bernilai 1 (barang sedang digunakan)
    if ($item->status_borrow == 1) {
        return response()->json([
            'success' => false,
            'message' => 'Item sedang digunakan',
            'status_borrows' => 1
        ]);
    }
    // Jika item ditemukan dan tidak sedang digunakan
    return response()->json([
        'success' => true,
        'name_item' => $item->name_item, // Sesuaikan dengan nama field yang Anda gunakan
        'status_borrows' => $item->status_borrows // Pastikan field ini ada di tabel
    ]);
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
            'street' => ($employe->street == null ? 'UNKNOWN DIVISION' : $employe->street), 
            'divisi_name' => ($employe->divisi_name == null ? 'UNKNOWN DIVISION' : $employe->divisi_name)
        ]);
    }
    return response()->json(['success' => false]);
}



public function storeBorrow(Request $request)
    {
        $nikEmployes = $request->input('nikEmploye');
        $array = explode('|', $nikEmployes);
        $badgeEmploye = $array[2];
        date_default_timezone_set('Asia/Jakarta');
        $ldate = date('Y-m-d H:i:s');
        // Validasi data yang dikirim dari AJAX
        $validatedData = $request->validate([
            'nikEmploye' => 'required',
            'kodeItems' => 'required|array',
        ]);

        // Loop melalui kode item untuk menyimpannya satu per satu (sesuai kebutuhan)
        foreach ($validatedData['kodeItems'] as $kodeItem) {
            TransactionItemModel::create([
                'badgenumber' => $badgeEmploye,
                'item_code' => $kodeItem,
                'status' => 1,
                'last_status' => 1,
                'date_borrow' => $ldate
            ]);

            // Update field di tabel lain berdasarkan item_codeds
            MasterItemModel::where('item_code', $kodeItem)
                ->update(['status_borrows' => 1]);
        }

        // Berikan respons sukses ke client
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
    // end code untuk pinjam item

// ------------------------------------------batas-------------------------------------//


public function take_the_borrowed_item($kode) {
    $item = TransactionItemModel::select(
            'transactions_items_borrow.*', 
            'item_master_borrow.name_item',
            'item_master_borrow.divisi_id as tools_divisi_id', // Alias untuk divisi_id dari item_master_borrow
            'employees.name',
            'employees.divisi_id as employee_divisi_id', // Alias untuk divisi_id dari employees_tb
            'ms_divisi_item.divisi_name as tools_divisi_name', // Nama divisi dari item_master_borrow
            'ms_divisi_emp.divisi_name as employee_divisi_name', // Nama divisi dari employees_tb
            'ms_divisi_item.divisi_alias'
        )
        ->join('item_master_borrow', 'transactions_items_borrow.item_code', '=', 'item_master_borrow.item_code')
        ->join('employees', 'transactions_items_borrow.badgenumber', '=', 'employees.badgenumber')
        
        // Join untuk mengambil divisi dari item_master_borrow
        ->join('ms_divisi as ms_divisi_item', 'item_master_borrow.divisi_id', '=', 'ms_divisi_item.divisi_id') 
        
        // Join untuk mengambil divisi dari employees_tb
        ->join('ms_divisi as ms_divisi_emp', 'employees.divisi_id', '=', 'ms_divisi_emp.divisi_id')
        
        ->where('transactions_items_borrow.item_code', $kode)
        ->where('transactions_items_borrow.status', 1)
        ->first();

    // Cek apakah item ditemukan
    if (!$item) {
        return response()->json([
            'success' => false,
            'message' => 'Item not found'
        ]);
    }

    // Jika item ditemukan dan tidak sedang digunakan
    return response()->json([
        'success' => true,
        'name_item' => $item->name_item, 
        'name' => $item->name,
        'tools_divisi_name' => $item->tools_divisi_name, // Nama divisi dari item_master_borrow
        'employee_divisi_name' => $item->employee_divisi_name, // Nama divisi dari employees_tb
        'tools_divisi_id' => $item->tools_divisi_id, // divisi_id dari tabel item_master_borrow
        'employee_divisi_id' => $item->employee_divisi_id, // divisi_id dari tabel employees_tb
        'date_borrow' => format_date_indonesia($item->date_borrow), 
        'return_date' => ($item->return_date == null ? '<span class="badge badge-danger">Belum ada tanggal pengembalian</span>' : $item->return_date), 
        'status' => ($item->status == 1 ? '<span class="badge badge-danger">Sedang dipinjam</span>' : '<span class="badge badge-primary">Tidak dipinjam</span>'), 
        'last_status' => ($item->last_status == 1 ? '<span class="badge badge-danger">Belum dikembalikan</span>' : '<span class="badge badge-primary">Sudah dikembalikan</span>')
    ]);
}




    public function ReturnBorrow(Request $request) {
        date_default_timezone_set('Asia/Jakarta');
        $ldate = date('Y-m-d H:i:s');
    
        // Validasi data yang dikirim dari AJAX
        $validatedData = $request->validate([
            'kodeItems' => 'required|array',
        ]);
    
        // Ambil data kode item dari request
        $kodeItems = $validatedData['kodeItems'];
        
        foreach ($kodeItems as $itemCode) {
            // Ambil item berdasarkan item_code, dengan kondisi tambahan
            $item = TransactionItemModel::where('item_code', $itemCode)
                ->where('status', 1)  // Kondisi untuk status = 1
                ->whereNotNull('last_status')  // Kondisi last_status tidak kosong
                ->whereNull('return_date')  // Kondisi return_date bernilai null
                ->first();
            
            if ($item) {
                // Update status dan last_status
                $item->status = '0';
                $item->last_status = '0';
                $item->return_date = $ldate;
                $item->updated_at = now();
                $item->save();
            }

            // Update field di tabel lain berdasarkan item_code
            MasterItemModel::where('item_code', $itemCode)
            ->update(['status_borrows' => 0]);
        }
        return response()->json(['success' => true, 'message' => 'Data berhasil disimpan']);
    }
    
    // end code untuk kembalikan  item

}
