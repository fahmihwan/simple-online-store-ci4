<?php

namespace Config;

use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    //--------------------------------------------------------------------
    // Rules
    //--------------------------------------------------------------------
    public $register = [
        'username' => [
            'rules' => 'required|min_length[5]',
        ],
        'password' => [
            'rules' => 'required|min_length[6]',
        ],
        'repeatPassword' => [
            'rules' => 'required|matches[password]'
        ]
    ];

    public $register_errors = [
        'username' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 5 karakter',
        ],
        'password' => [
            'required' => '{field} harus diisi',
            'min_length' => '{field} Minimal 6 karakter'
        ],
        'repeatPassword' => [
            'required' => '{field} harus diisi',
            'matches' => '{field} tidak Match dengan password',
        ],
    ];

    public $login = [
        'username' => [
            'rules' => 'required|min_length[5]',
        ],
        'password' => [
            'rules' => 'required|min_length[6]',
        ],
    ];

    public $login_errors = [
        'username' => [
            'required' => '{field} Harus Diisi',
            'min_length' => '{field} Minimal 5 karakter',
        ],
        'password' => [
            'required' => '{field} harus diisi',
            'min_length' => '{field} Minimal 6 karakter',
        ],
    ];

    public $barang = [
        'nama' => [
            'rules' => 'required|min_length[3]',
        ],
        'harga' => [
            'rules' => 'required|is_natural',
        ],
        'stok' => [
            'rules' => 'required|is_natural',
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]',
        ],
    ];

    public $barang_errors = [
        'nama' => [
            'required' => '{field} harus diisi',
            'min_length' => '{field} Minimum Karakter 3',
        ],
        'harga' => [
            'required' => '{field} harus diisi',
            'is_natural' => 'tidak boleh bernilai negatif',
        ],
        'stok' => [
            'required' => '{field} harus diisi',
            'is_natural' => '{field} tidak boleh kosong',
        ],
        'gambar' => [
            'uploaded' => '{field} harus upload gambar',
        ],
    ];
    public $barangUpdate = [
        'nama' => [
            'rules' => 'required|min_length[3]',
        ],
        'harga' => [
            'rules' => 'required|is_natural',
        ],
        'stok' => [
            'rules' => 'required|is_natural',
        ],
        'gambar' => [
            'rules' => 'uploaded[gambar]',
        ],
    ];

    public $barang_errorsUpdate = [
        'nama' => [
            'required' => '{field} harus diisi',
            'min_length' => '{field} Minimum Karakter 3',
        ],
        'harga' => [
            'required' => '{field} harus diisi',
            'is_natural' => 'tidak boleh bernilai negatif',
        ],
        'stok' => [
            'required' => '{field} harus diisi',
            'is_natural' => '{field} tidak boleh kosong',
        ],
        'gambar' => [
            'uploaded' => '{field} harus upload gambar',
        ],
    ];

    public $transaksi = [
        'id_barang' => [
            'rules' => 'required',
        ],
        'id_pembeli' => [
            'rules' => 'required',
        ],
        'jumlah' => [
            'rules' => 'required',
        ],
        'total_harga' => [
            'rules' => 'required',
        ],
        'alamat' => [
            'rules' => 'required',
        ],
        'ongkir' => [
            'rules' => 'required',
        ],
    ];

    public $komentar = [
        'komentar' => [
            'rules' => 'required',
        ],
    ];
}
