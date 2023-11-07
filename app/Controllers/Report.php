<?php

namespace App\Controllers;

use App\Models\useradModel;
use App\Models\CategoryMasterDivisi;
use App\Models\CategoryMasterStatus;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Doctrine\Common\Annotations\Reader;
use TCPDF;

class Report extends BaseController
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
        $dataDivisi = $this->categoryMasterDivisi->findAll();
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



        return view('report/laporan', $data);
    }
    public function exportPDF()
    {
        $inventory = $this->useradModel->getUserAd();
        $divisionUserCounts = $this->useradModel->countUsersPerDivision();
        $divisiAssociations = [
            1 => 'Divisi Akutansi',
            2 => 'Divisi Sekper',
            3 => 'Divisi Keuangan',
            4 => 'Divisi SDM',
            5 => 'Divisi Komersial',
            6 => 'Divisi Perencanaan Bisnis',
        ];

        $statusAssociations = [
            1 => 'Normal',
            2 => 'Rusak',
        ];

        $divisionUserCount = count($inventory); // Menghitung jumlah data inventaris

        $data = [
            'title' => 'Laporan Inventory',
            'result' => $inventory,
            'divisiAssociations' => $divisiAssociations,
            'statusAssociations' => $statusAssociations,
            'divisionUserCounts' => $divisionUserCounts,
        ];

        $html = view('report/exportPDF', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan-inventory.pdf', 'I');
    }
    public function exportpdfAkutansi()
    {
        // Mendapatkan parameter ID dari URL
        $idParam = $this->request->getGet('id');

        // Memisahkan nilai ID menjadi array berdasarkan koma
        $ids = explode(',', $idParam);

        // Lakukan operasi sesuai dengan ID yang dipilih
        $inventory = $this->useradModel->getUserAdAkutansi(false, $ids);
        $divisionUserCounts = $this->useradModel->countUsersAkutansiDivision($ids);

        $divisiAssociations = [
            1 => 'Divisi Akutansi',
            2 => 'Divisi Sekper',
            3 => 'Divisi Keuangan',
            4 => 'Divisi SDM',
            5 => 'Divisi Komersial',
            6 => 'Divisi Perencanaan Bisnis',
        ];

        $statusAssociations = [
            1 => 'Normal',
            2 => 'Rusak',
        ];

        $divisionUserCount = count($inventory);

        $data = [
            'title' => 'Laporan Inventory',
            'result' => $inventory,
            'divisiAssociations' => $divisiAssociations,
            'statusAssociations' => $statusAssociations,
            'divisionUserCounts' => $divisionUserCounts,
        ];

        $html = view('report/exportPDF', $data);

        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('laporan-inventory.pdf', 'I');
    }
}
