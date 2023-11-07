<?php
namespace App\Controllers;

use \App\Models\AkutansiModel;
use \App\Models\CategoryAkutansi;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Doctrine\Common\Annotations\Reader;

class Akutansi extends BaseController
{

    private $akutansiModel, $akutansiKat;
    public function __construct()
    {
        $this->akutansiModel = new AkutansiModel();
        $this->akutansiKat = new CategoryAkutansi();
    }

    public function index()
    {
        $dataAkutansi = $this->akutansiModel->getAkutansi();
        $data = [
            'title' => 'Data Inventory Sumber Daya Manusia',
            'result' => $dataAkutansi
        ];
        return view('akutansi/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Akutansi',
            'kategori' => $this->akutansiKat->findAll(),
            'validation' => \Config\Services::validation(),
        ];

        return view('akutansi/create', $data);
    }

    public function detail($slug)
    {
        $dataAkutansi = $this->akutansiModel->getAkutansi($slug);
        $data = [
            'title' => 'Data Inventory Sumber Daya Manusia',
            'result' => $dataAkutansi
        ];
        return view('akutansi/detail', $data);
    }
    
    public function save()
    {

        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'ip_address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'serial_number' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'computer_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'monitor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'tipe_komputer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
        

        ])) {
            return redirect()->to('/akutansi/create')->withInput();
        }

    
        $slug = url_title($this->request->getVar('nama_user'), '-', true);
        $this->akutansiModel->save([
            'nama_user' => $this->request->getvar('nama_user'),
            'ip_address' => $this->request->getvar('ip_address'),
            'serial_number' => $this->request->getvar('serial_number'),
            'computer_name' => $this->request->getvar('computer_name'),
            'monitor' => $this->request->getvar('monitor'),
            'tipe_komputer' => $this->request->getvar('tipe_komputer'),
            'akutansi_category_id' => $this->request->getvar('status'),
            'slug' => $slug,
            
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan!");

        return redirect()->to('/akutansi');
    }

    
    public function edit($slug)
    {
        $dataAkutansi = $this->akutansiModel->getAkutansi($slug);

        if (empty($dataAkutansi)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Nama U $slug Tidak Ditemukan!!!");
        }

        $data = [
            'title' => 'Ubah Data Inventory Sumber Daya Manusia',
            'kategori' => $this->akutansiKat->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataAkutansi
        ];
        return view('akutansi/edit', $data);
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} sudah ada'
                ]
            ],
            'ip_address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'serial_number' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'computer_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'monitor' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'tipe_komputer' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
        
        ])) {
            return redirect()->to('/akutansi/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('nama_user'), '-', true);
        $this->akutansiModel->save([
            'no_id' => $id,
            'nama_user' => $this->request->getvar('nama_user'),
            'ip_address' => $this->request->getvar('ip_address'),
            'serial_number' => $this->request->getvar('serial_number'),
            'computer_name' => $this->request->getvar('computer_name'),
            'monitor' => $this->request->getvar('monitor'),
            'tipe_komputer' => $this->request->getvar('tipe_komputer'),
            'akutansi_category_id' => $this->request->getvar('status'),
            'slug' => $slug,
            
        ]);
       

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/akutansi');
    }



    public function delete($id)
    {
        $this->akutansiModel->delete($id);

        session()->setFlashdata("msg", "Data berhasil dihapus!");

        return redirect()->to('/akutansi');
    }

    public function exportToExcel()
{
    $data = $this->findAll(); // Mengambil data dari tabel

    return $data;
}

public function importData()
{
    $file = $this->request->getFile("file");
    $ext = $file->getExtension();
    if ($ext == "xls") {
        $reader = new Xls();
    } else {
        $reader = new Xlsx();
    }

    $spreadsheet = $reader->load($file);
    $sheet = $spreadsheet->getActiveSheet()->toArray();

    foreach ($sheet as $key => $value) {
        if ($key == 0) continue;

        $nama_user = $value[1];

        // Cek apakah data dengan nama_user yang sama sudah ada
        $existingData = $this->akutansiModel->getAkutansiByNamaUser($nama_user);

        if (empty($existingData)) {
            // Jika data tidak ada, tambahkan data baru
            $this->akutansiModel->save([
                'nama_user' => $value[1],
                'ip_address' => $value[2],
                'serial_number' => $value[3],
                'computer_name' => $value[4],
                'monitor' => $value[5] ?? 0,
                'tipe_komputer' => $value[6],
                'akutansi_category_id' => $value[7],
                'slug' => url_title($value[1], '-', true) // Menggunakan URL-friendly nama_user sebagai slug
            ]);
        }
    }

    session()->setFlashdata("msg", "Data berhasil diimport!");

    return redirect()->to('/akutansi');
}

public function countNamaUser()
{
    $jumlahNamaUser = $this->akutansiModel->countNamaUserOccurrences();
    
    $data = [
        'title' => 'Total Kemunculan nama_user',
        'jumlahNamaUser' => $jumlahNamaUser
    ];
    
    return view('dashboard', $data);
}



  
}
