<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\BarangEntities;
use App\Entities\TransaksiEntities;
use App\Models\BarangModel;
use App\Models\KomentarModel;
use App\Models\TransaksiModel;

class Etalase extends BaseController
{

    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "13b06e5faf22b182c21f127a8af2719e";

    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->BarangModel = new BarangModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->TransaksiEntities = new TransaksiEntities();
        $this->session = session();
        $this->KomentarModel = new KomentarModel();
    }

    public function index()
    {
        $data = [
            'barang' => $this->BarangModel->findAll(),
        ];
        return view('etalase/index', $data);
    }

    public function beli()
    {


        $id = $this->request->uri->getSegment(3);

        $provinsi = $this->rajaOngkir('province');

        $dataBarang = $this->BarangModel->find($id);


        if ($this->request->getVar()) {
            $data = $this->request->getVar();

            $this->validation->run($data, 'transaksi');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                // belum menggunakan database transaction
                // update 
                $barangEntity = new BarangEntities();
                $barangEntity->stok =  $dataBarang->stok - $this->request->getVar('jumlah');
                $this->BarangModel->update($dataBarang->id, ['stok' => $barangEntity->stok]);

                // insert 
                $this->TransaksiEntities->fill($data);
                $this->TransaksiEntities->status = 0;
                $this->TransaksiEntities->created_by = $this->session->get('id');
                $this->TransaksiEntities->created_date = date('Y-m-d H:i:s');
                $this->TransaksiModel->save($this->TransaksiEntities);
                $id = $this->TransaksiModel->insertID();

                return redirect()->to(site_url('transaksi/view/' . $id));
            } else {
                dd($this->validation->getErrors());
            }
        }

        $komentar = $this->KomentarModel->select('komentar, komentar.created_date as date_comment, username')
            ->join('user', 'user.id = komentar.id_user')->where('id_barang', $id)
            ->find();

        return view('etalase/beli', [
            'barang' => $dataBarang,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
            'komentar' => $komentar,
        ]);
    }





    private function rajaOngkir($method, $id_provinsi = null)
    {
        $endPoint = $this->url . $method;

        if ($id_provinsi != null) {
            $endPoint .=  "?province=" . $id_provinsi;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: $this->apiKey"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_provinsi = $this->request->getGET('id_province');
            $data = $this->rajaOngkir('city', $id_provinsi);
            return $this->response->setJSON($data);
        }
    }


    private function rajaOngkirCost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$origin&destination=$destination&weight=$weight&courier=$courier",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: $this->apiKey"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaOngkirCost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }
}
