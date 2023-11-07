<?php

namespace App\Models;

use CodeIgniter\Model;

class useradModel extends Model
{
    // Nama Tabel
    protected $table        = 'user_ad';
    // Atribut yang digunakan menjadi primary key
    protected $primaryKey   = 'no_id';
    // Atribut untuk menyimpan created_at dan updated_at
    protected $useTimestamps = true;

    protected $allowedFields = [
        'master_category_id', 'nama_user', 'slug',
        'ip_address', 'serial_number', 'computer_name', 'monitor', 'tipe_komputer', 'cover',  'master_category_status_id',  'catatan'
    ];

    protected $useSoftDeletes = true;



    public function getUserAd($slug = false)
    {
        $query = $this->table('user_ad')
            ->join('master_category_divisi', 'master_category_divisi.master_category_id = user_ad.master_category_id')
            ->join('master_category_status', 'master_category_status.master_category_status_id = user_ad.master_category_status_id')

            ->where('user_ad.deleted_at IS NULL');

        if ($slug === false) {
            return $query->get()->getResultArray();
        }

        return $query->where(['slug' => $slug])->first();
    }

    public function getNewUserData($userId)
    {
        return $this->select('user_ad.*, master_category_divisi.nama_divisi, master_category_status.nama_kategori as status')
            ->join('master_category_divisi', 'master_category_divisi.master_category_id = user_ad.master_category_id')
            ->join('master_category_status', 'master_category_status.master_category_status_id = user_ad.master_category_status_id')
            ->where('user_ad.no_id', $userId)
            ->first();
    }
    public function getUserAdAkutansi($slug = false, $ids)
    {
        $query = $this->table('user_ad')
            ->join('master_category_divisi', 'master_category_divisi.master_category_id = user_ad.master_category_id')
            ->join('master_category_status', 'master_category_status.master_category_status_id = user_ad.master_category_status_id')

            ->where('user_ad.deleted_at IS NULL')
            ->whereIn('user_ad.master_category_id', $ids);
        if ($slug === false) {
            return $query->get()->getResultArray();
        }

        return $query->where(['slug' => $slug])->first();
    }

    public function getSdmByNamaUser($namaUser)
    {
        return $this->where('nama_user', $namaUser)
            ->where('deleted_at is null')
            ->get()
            ->getResultArray();
    }

    public function countUsersPerDivision()
    {
        // Query untuk menghitung jumlah pengguna per divisi
        $query = $this->select('master_category_id, COUNT(*) as user_count')
            ->groupBy('master_category_id')
            ->getWhere('deleted_at IS NULL');

        $results = $query->getResultArray();

        $divisionUserCounts = [];

        foreach ($results as $result) {
            $divisionUserCounts[$result['master_category_id']] = $result['user_count'];
        }

        return $divisionUserCounts;
    }
    public function countUsersAkutansiDivision($ids)
    {
        // Query untuk menghitung jumlah pengguna divisi akutansi
        $query = $this->select('master_category_id, COUNT(*) as user_count')
            ->whereIn('master_category_id', $ids)
            ->groupBy('master_category_id')
            ->getWhere('deleted_at IS NULL');

        $results = $query->getResultArray();

        $divisionUserCounts = [];

        foreach ($results as $result) {
            $divisionUserCounts[$result['master_category_id']] = $result['user_count'];
        }

        return $divisionUserCounts;
    }

    public function getDataByDivisions($divisions)
    {

        $query = $this->select('*')
            ->whereIn('master_category_id', $divisions);
        return $query->findAll();
    }
}
