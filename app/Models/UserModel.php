<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'ms_user';

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'user_id';

    // Jika primary key bukan auto-incrementing integer
    // public $incrementing = false;
    public $incrementing = true;

    // Menentukan apakah timestamps diaktifkan
    public $timestamps = true;
    protected $fillable = [
        'username',
        'fullname',
        'email',
        'password',
        'role_id',
        'is_active',
        'image',
    ];

     //for helper getuserdata
    public function employee()
    {
        return $this->hasOne(EmployeModel::class, 'id_employee', 'id_employee'); // Sesuaikan dengan nama kolom yang tepat
    }


    
}
