<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BarangModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use TCPDF;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->TransaksiModel = new TransaksiModel();
        $this->UserModel = new UserModel();
        $this->BarangModel = new BarangModel();
        $this->email = \Config\Services::email();
    }

    public function view($id)
    {
        $data = $this->TransaksiModel->select('nama, username, alamat, jumlah, total_harga')
            ->join('user', 'user.id = transaksi.id_pembeli')
            ->join('barang', 'barang.id = transaksi.id_barang')
            ->where('transaksi.id', $id)
            ->first();


        return view('transaksi/view', [
            'data' => $data,
        ]);
    }

    public function index()
    {
        $transaksiModel = new TransaksiModel();
        return view('transaksi/index', [
            'model' => $transaksiModel->findAll(),
        ]);
    }

    public function invoice($id)
    {
        $transaksi = $this->TransaksiModel->find($id);
        $pembeli = $this->UserModel->find($transaksi->id_pembeli);
        $barang = $this->BarangModel->find($transaksi->id_barang);

        $html = view('transaksi/invoice', [
            'transaksi' => $transaksi,
            'pembeli' => $pembeli,
            'barang' => $barang,
        ]);

        // $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);
        $pdf = new TCPDF('L', PDF_UNIT, 'A5 ', true, 'UTF-8', false);
        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Fahmi Ichwanurrohman');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        $pdf->writeHTML($html, true, false, true, false, '');

        //jika ingin print di browser tinggal aktifkan script di bawah
        $this->response->setContentType('application/pdf');
        $pdf->Output('invoice.pdf', 'I');



        // jika ingin mengirimkan ke email bisa aktidkan syntx ini 
        // $pdf->Output(__DIR__ . './../../public/uploads/invoice.pdf', 'F');
        // $attachment = base_url('uploads/Invoice.pdf');

        // $message = "<h1>Invoice Pembelian</h1><p>Kepada $pembeli->username </p>
        // Berikut Invoice atas pembelian $barang->nam";

        // $this->sendEmail($attachment, 'fahmiiwan86@gmail.com', 'Invoice', $message);

        // return redirect()->to(site_url('transaksi/index'));
    }


    // private function sendEmail($attachment, $to, $title, $message)
    // {

    //     $this->email->setFrom('fahmiihwan86@gmail.com', 'Dari Akun Kanibal');
    //     $this->email->setTo($to);

    //     $this->email->attach($attachment);
    //     $this->email->setSubject($title);
    //     $this->email->setMessage($message);

    //     if (!$this->email->send()) {
    //         return false;
    //     } else {
    //         return true;
    //     };
    // }
}
