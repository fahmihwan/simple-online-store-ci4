<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaksi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'id_pembeli' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'id_barang' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
            ],
            'jumlah' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'total_harga' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'alamat' => [
                'type' => 'TEXT',
            ],
            'ongkir' => [
                'type' => 'INT'
            ],
            'status' => [
                'type' => 'INT',
                'constraint' => 1,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'created_date' => [
                'type' => 'DATETIME'
            ],
            'updated_by' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'updated_date' => [
                'type' => 'DATETIME'
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_pembeli', 'user', 'id');
        $this->forge->addForeignKey('id_barang', 'barang', 'id');
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi');
    }
}
