<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    use HasFactory;
    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'ms_user';

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'user_id';

    // Jika primary key bukan auto-incrementing integer
    // public $incrementing = false;
    public $incrementing = true;


}
