<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItemModel extends Model
{
    use HasFactory;
    
    // Menentukan nama tabel yang terkait dengan model ini
    protected $table = 'transactions_items_borrow';

    // Menentukan primary key jika bukan 'id'
    protected $primaryKey = 'borrow_id';

    // Jika primary key bukan auto-incrementing integer
    // public $incrementing = false;
    public $incrementing = true;
    // Jika primary key bukan integer
    // protected $keyType = 'string';
    // Menentukan apakah timestamps diaktifkan
    public $timestamps = true;
    
    protected $fillable = [
        'nik',
        'item_code',
        'status',
        'last_status',
        'date_borrow',
        'return_date',
        'created_at',
        'updated_at',
    ];
}
