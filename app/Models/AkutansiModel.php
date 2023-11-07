<?php

namespace App\Models;

use CodeIgniter\Model;

class akutansiModel extends Model
{
    // Nama Tabel
    protected $table        = 'akutansi';
    // Atribut yang digunakan menjadi primary key
    protected $primaryKey   = 'no_id';
    // Atribut untuk menyimpan created_at dan updated_at
    protected $useTimestamps = true;

    protected $allowedFields = [
        'nama_user', 'slug', 'ip_address', 'serial_number', 'computer_name', 'monitor', 'tipe_komputer', 'cover',  'akutansi_category_id'];

 

    public function getAkutansi($slug = false)
    {
        $query = $this->table('akutansi')
            ->join('akutansi_category', 'akutansi_category_id')
            ->where('deleted_at is null');
        
        if ($slug == false)
            return $query->get()->getResultArray();
        return $query->where(['slug' => $slug])->first();
    }

    public function getAkutansiByNamaUser($namaUser)
{
    return $this->where('nama_user', $namaUser)
        ->where('deleted_at is null')
        ->get()
        ->getResultArray();
}

}


