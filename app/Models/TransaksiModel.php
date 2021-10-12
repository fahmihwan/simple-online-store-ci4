<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table                = 'transaksi';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $returnType           = 'App\Entities\TransaksiEntities';
    protected $allowedFields        = [
        'id_pembeli', 'id_barang', 'jumlah', 'total_harga', 'alamat', 'ongkir', 'status', 'created_by', 'created_date', 'updated_by', 'updated_date'
    ];
    protected $useTimestamps        = false;
}
