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
    protected $table = 'employees_tb';

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'id_employee';

    // Jika primary key bukan auto-incrementing integer
    // public $incrementing = false;
    public $incrementing = true;

    // Jika primary key bukan integer
    // protected $keyType = 'string';
    // Menentukan apakah timestamps diaktifkan
    public $timestamps = true;
}
