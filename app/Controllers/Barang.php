<?php

namespace App\Controllers;

use App\Entities\BarangEntities;
use App\Models\BarangModel;

class Barang extends BaseController
{
    protected $Validation;
    protected $BarangModel;
    protected $entities_barang;

    public function __construct()
    {
        helper('form');
        $this->Validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->BarangModel = new BarangModel();
        $this->entities_barang = new BarangEntities();
    }

    public function index()
    {
        $data = [
            'barangs' => $this->BarangModel->findAll(),
        ];
        return view('barang/index', $data);
    }

    public function view()
    {

        $id = $this->request->uri->getSegments(3);
        $data = [
            'barang' => $this->BarangModel->find($id),
        ];

        return view('barang/view', $data);
    }
    public function create()
    {
        if ($this->request->getVar()) {
            $data = $this->request->getVar();

            $this->Validation->run($data, 'barang');
            $errors = $this->Validation->getErrors();
            if (!$errors) {
                $this->entities_barang->fill($data);
                $this->entities_barang->gambar = $this->request->getFile('gambar');
                $this->entities_barang->created_by = $this->session->get('id');
                $this->entities_barang->created_date = date('Y-m-d H:i:s');
                $this->BarangModel->save($this->entities_barang);

                $id = $this->BarangModel->insertID(); //ambil ID terakhir setelah di insert tadi (insertID());

                return redirect()->to(site_url('barang/view/' . $id));
            } else {
                $this->session->setFlashdata('errors', $this->Validation->getErrors());
                return redirect()->to('barang/create');
            }
        }
        return view('barang/create');
    }

    public function update()
    {
        $id = $this->request->uri->getSegment(3);
        $barang = $this->BarangModel->find($id);

        if ($data = $this->request->getVar()) {
            $this->Validation->run($data, 'barangUpdate');
            $error = $this->Validation->getError();

            if (!$error) {
                $this->entities_barang->fill($this->request->getVar());

                if ($this->request->getFile('gambar')->isValid()) {
                    $this->entities_barang->gambar = $this->request->getFile('gambar');
                    $this->entities_barang->created_by = $this->session->get('id');
                    $this->entities_barang->created_date = date('Y-m-d H:i:s');

                    $this->BarangModel->save($this->entities_barang);

                    return redirect()->to(site_url('barang/view/' . $this->request->getVar('id')));
                }
            }
        }
        $data = [
            'barang' => $barang,
        ];
        return view('barang/update', $data);
    }

    public function delete()
    {
        $id = $this->request->uri->getSegment(3);

        $this->BarangModel->delete($id);

        return redirect()->to(site_url('barang/index'));
    }
}
