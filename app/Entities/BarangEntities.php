<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class BarangEntities extends Entity
{
    public function setGambar($file)
    {
        $fileName = $file->getRandomName();
        $file->move('./uploads', $fileName);
        $this->attributes['gambar'] = $fileName;
        return $this;
    }
}
