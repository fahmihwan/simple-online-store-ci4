<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\KomentarEntities;
use App\Models\KomentarModel;

class Komentar extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();;
        $this->session = session();
        $this->KomentarEntities = new KomentarEntities();
    }


    public function create()
    {
        $id_barang = $this->request->uri->getSegment(3);
        $model = new KomentarModel();
        if ($this->request->getVar()) {
            $this->validation->run($this->request->getVar(), 'komentar');
            $err = $this->validation->getErrors();

            if (!$err) {
                $this->KomentarEntities->fill($this->request->getVar());
                $this->KomentarEntities->created_by = $this->session->get('id');
                $this->KomentarEntities->created_date = date('Y-m-d H:i:s');

                $model->save($this->KomentarEntities);

                return redirect()->to(site_url('etalase/beli/' . $this->request->getVar('id_barang')));
            } else {
                dd($err);
            }
        }

        return view('komentar/create', [
            'id_barang' => $id_barang,
            'model' => $model,
        ]);
    }
}
