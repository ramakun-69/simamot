<?php

namespace App\Models;

use CodeIgniter\Model;

class UserAkutansiModel extends Model
{
    protected $table = 'akutansi'; // Ganti 'nama_tabel_pengguna' dengan nama tabel pengguna di database Anda
    protected $primaryKey = 'no_id'; // Ganti 'id' dengan nama kolom yang digunakan sebagai primary key

    // Definisikan properti lainnya sesuai kebutuhan, seperti validation rules atau callback methods.

    // Contoh method untuk mengambil data pengguna
    public function getAllUsers()
    {
        return $this->findAll();
    }

    // Metode lainnya sesuai kebutuhan
}
