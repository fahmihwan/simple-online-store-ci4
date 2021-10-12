<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
    protected $table                = 'komentar';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'App\Entities\KomentarEntities';
    protected $useSoftDeletes       = false;
    protected $allowedFields        = ['id_user', 'id_barang', 'komentar', 'created_by', 'created_date', 'updated_by', 'updated_date'];
}
