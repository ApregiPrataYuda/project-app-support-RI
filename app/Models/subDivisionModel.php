<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subDivisionModel extends Model
{
    use HasFactory;
    
    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'ms_subdivision';

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'id_subdivision';

    // Jika primary key bukan auto-incrementing integer
    // public $incrementing = false;
    public $incrementing = true;

    // Jika primary key bukan integer
    // protected $keyType = 'string';
    // Menentukan apakah timestamps diaktifkan
    public $timestamps = true;
}
