<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EmployeModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'employees';

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'id_employee';

    // Jika primary key bukan auto-incrementing integer
    // public $incrementing = false;
    public $incrementing = true;

    // Jika primary key bukan integer
    // protected $keyType = 'string';
    // Menentukan apakah timestamps diaktifkan
    public $timestamps = true;

    // Relasi ke tabel ms_divisi
    public function divisi()
    {
        return $this->belongsTo(DivisionModel::class, 'divisi_id', 'divisi_id');
    }

    public function branch()
    {
        return $this->belongsTo(BranchModel::class, 'branch_id','id_branch'); // Pastikan relasi ini ada
    }
}
