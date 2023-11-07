<?php

namespace App\Controllers;



use App\Models\useradModel;
use App\Controllers\BaseController;
use App\Models\CategoryMasterDivisi;
use App\Models\CategoryMasterStatus;
use Doctrine\Common\Annotations\Reader;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\ValidationException;

class UserAd extends BaseController
{
    private $useradModel;
    private $categoryMasterDivisi;
    private $categoryMasterStatus;

    public function __construct()
    {
        $this->useradModel =  new UseradModel();
        $this->categoryMasterDivisi = new CategoryMasterDivisi();
        $this->categoryMasterStatus = new CategoryMasterStatus();
    }


    public function index()
    {
        $dataUserAd = $this->useradModel->getUserAd(); // Menggunakan metode getUserAd
        $dataDivisi = $this->categoryMasterDivisi->findAll(); // Mengambil data divisi
        $dataStatus = $this->categoryMasterStatus->findAll(); // Mengambil data status


        $divisiAssociations = [];
        foreach ($dataDivisi as $divisi) {
            $divisiAssociations[$divisi['master_category_id']] = $divisi['nama_divisi'];
        }

        $statusAssociations = [];
        foreach ($dataStatus as $status) {
            $statusAssociations[$status['master_category_status_id']] = $status['nama_kategori'];
        }

        $data = [
            'title' => 'Data Inventory',
            'result' => $dataUserAd,
            'divisiData' => $dataDivisi, // Menyimpan data divisi
            'dataStatus' => $dataStatus, // Menyimpan data status
            'divisiAssociations' => $divisiAssociations, // Menyimpan asosiasi divisi
            'statusAssociations' => $statusAssociations, // Menyimpan asosiasi status
        ];



        return view('userad/index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah User Ad',
            'kategori' => $this->categoryMasterDivisi->findAll(),
            'status' => $this->categoryMasterStatus->findAll(),
            'validation' => \Config\Services::validation(),
        ];
        return view('userad/create', $data);
    }

    public function detail($slug)
    {
        $dataUserAd = $this->useradModel->getUserAd($slug);

        if (empty($dataUserAd)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Nama User Ad $slug Tidak Ditemukan!!!");
        }

        $data = [
            'title' => 'Detail Inventory',
            'result' => $dataUserAd
        ];

        return view('userad/detail', $data);
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
            'catatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],


        ])) {
            return redirect()->to('/userad/create')->withInput();
        }


        $slug = url_title($this->request->getVar('nama_user'), '-', true);
        $dataToSave = [
            'nama_user' => $this->request->getvar('nama_user'),
            'master_category_id' => $this->request->getvar('master_category_id'),
            'ip_address' => $this->request->getvar('ip_address'),
            'serial_number' => $this->request->getvar('serial_number'),
            'computer_name' => $this->request->getvar('computer_name'),
            'monitor' => $this->request->getvar('monitor'),
            'tipe_komputer' => $this->request->getvar('tipe_komputer'),
            'master_category_status_id' => $this->request->getvar('master_category_status_id'),
            'catatan' => $this->request->getvar('catatan'),
            'slug' => $slug,

        ];
        $save = $this->useradModel->save($dataToSave);
        $newUserId = $this->useradModel->getInsertID();
        // dd($newUserId);
        if ($save && $newUserId) {
            $newUserData = $this->useradModel->getNewUserData($this->useradModel->getInsertID());

            if (!empty($newUserData)) {

                $qrCodeData = "Nama Divisi: " . $newUserData['nama_divisi'] . "\n"
                    . "IP Address: " . $newUserData['ip_address'] . "\n"
                    . "Computer Name: " . $newUserData['computer_name'] . "\n"
                    . "Monitor: " . $newUserData['monitor'] . "\n"
                    . "Tipe Komputer: " . $newUserData['tipe_komputer'] . "\n"
                    . "Status: " . $newUserData['status'] . "\n"
                    . "Catatan: " . $newUserData['catatan'];

                // Buat renderer dan writer QR code

                $writer = new PngWriter();
                // Create QR code
                $qrCode = QrCode::create($qrCodeData)
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
                    ->setSize(300)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
                    ->setForegroundColor(new Color(0, 0, 0))
                    ->setBackgroundColor(new Color(255, 255, 255));
                $result = $writer->write($qrCode);

                $result->saveToFile(FCPATH . 'qr-code/' . $newUserId . '_qrcode.png');
            }
        }

        session()->setFlashdata("msg", "Data berhasil ditambahkan!");

        return redirect()->to('/userad');
    }


    public function edit($slug)
    {

        $dataUserAd = $this->useradModel->getUserAd($slug);

        if (empty($dataUserAd)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Nama User Ad $slug Tidak Ditemukan!!!");
        }

        $data = [
            'title' => 'Ubah Data Inventory',
            'kategori' => $this->categoryMasterDivisi->findAll(),
            'status' => $this->categoryMasterStatus->findAll(),
            'validation' => \Config\Services::validation(),
            'result' => $dataUserAd
        ];
        return view('userad/edit', $data);
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
            'catatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],

        ])) {
            return redirect()->to('/userad/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $slug = url_title($this->request->getVar('nama_user'), '-', true);
        $this->useradModel->update($id, [
            'nama_user' => $this->request->getVar('nama_user'),
            'master_category_id' => $this->request->getVar('master_category_id'),
            'ip_address' => $this->request->getVar('ip_address'),
            'serial_number' => $this->request->getVar('serial_number'),
            'computer_name' => $this->request->getVar('computer_name'),
            'monitor' => $this->request->getVar('monitor'),
            'tipe_komputer' => $this->request->getVar('tipe_komputer'),
            'master_category_status_id' => $this->request->getVar('master_category_status_id'),
            'catatan' => $this->request->getVar('catatan'),
            'slug' => $slug,
        ]);






        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/userad');
    }



    public function delete($id)
    {
        $this->useradModel->delete($id);

        session()->setFlashdata("msg", "Data berhasil dihapus!");

        return redirect()->to('/userad');
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
            $existingData = $this->useradModel->getSdmByNamaUser($nama_user);

            if (empty($existingData)) {
                // Jika data tidak ada, tambahkan data baru
                $dataToSave = [
                    'nama_user' => $value[1],
                    'master_category_id' => $value[2],
                    'ip_address' => $value[3],
                    'serial_number' => $value[4],
                    'computer_name' => $value[5],
                    'monitor' => $value[6] ?? 0,
                    'tipe_komputer' => $value[7],
                    'master_category_status_id' => $value[8],
                    'slug' => url_title($value[1], '-', true) // Menggunakan URL-friendly nama_user sebagai slug
                ];
                $save = $this->useradModel->save($dataToSave);
                $newUserId = $this->useradModel->getInsertID();
                // dd($newUserId);
                if ($save && $newUserId) {
                    $newUserData = $this->useradModel->getNewUserData($this->useradModel->getInsertID());

                    if (!empty($newUserData)) {

                        $qrCodeData = "Nama Divisi: " . $newUserData['nama_divisi'] . "\n"
                            . "IP Address: " . $newUserData['ip_address'] . "\n"
                            . "Computer Name: " . $newUserData['computer_name'] . "\n"
                            . "Monitor: " . $newUserData['monitor'] . "\n"
                            . "Tipe Komputer: " . $newUserData['tipe_komputer'] . "\n"
                            . "Status: " . $newUserData['status'] . "\n"
                            . "Catatan: " . $newUserData['catatan'];

                        // Buat renderer dan writer QR code

                        $writer = new PngWriter();
                        // Create QR code
                        $qrCode = QrCode::create($qrCodeData)
                            ->setEncoding(new Encoding('UTF-8'))
                            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
                            ->setSize(300)
                            ->setMargin(10)
                            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
                            ->setForegroundColor(new Color(0, 0, 0))
                            ->setBackgroundColor(new Color(255, 255, 255));
                        $result = $writer->write($qrCode);

                        $result->saveToFile(FCPATH . 'qr-code/' . $newUserId . '_qrcode.png');
                    }
                }
            }
        }
        session()->setFlashdata("msg", "Data berhasil diimport!");

        return redirect()->to('/userad');
    }

    public function getFilteredData()
    {
        $selectedDivisions = $this->request->getPost('divisions');

        // Memanggil model untuk mengambil data
        $data = $this->useradModel->getDataByDivisions($selectedDivisions);

        $tableRows = '';

        foreach ($data as $row) {
            $tableRows .= '<tr>';
            $tableRows .= '<td>' . $row['no_id'] . '</td>';
            $tableRows .= '<td>' . $row['created_at'] . '</td>';
            $tableRows .= '<td>' . $row['updated_at'] . '</td>';
            $tableRows .= '<td>' . $row['nama_divisi'] . '</td>'; // Sesuaikan dengan kolom yang sesuai
            $tableRows .= '<td>' . $row['nama_user'] . '</td>';
            $tableRows .= '<td>' . $row['ip_address'] . '</td>';
            $tableRows .= '<td>' . $row['serial_number'] . '</td>';
            $tableRows .= '<td>' . $row['computer_name'] . '</td>';
            $tableRows .= '<td>' . $row['monitor'] . '</td>';
            $tableRows .= '<td>' . $row['tipe_komputer'] . '</td>';
            $tableRows .= '<td>' . $row['status_komputer'] . '</td>';
            $tableRows .= '</tr>';
        }

        return $this->response->setJSON($tableRows);
    }
}
