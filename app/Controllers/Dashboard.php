<?php

namespace App\Controllers;

use App\Models\UserAkutansiModel;

    class Dashboard extends BaseController
    {
        public function index()
        {
            $userModel = new UserAkutansiModel();
            $totalUsers = $userModel->countAll(); // Menghitung total pengguna
    
            $data = [
                'title' => 'Divisi Akutansi', // Definisikan variabel $title
                'jumlahNamaUser' => $totalUsers, // Definisikan variabel $jumlahNamaUser
            ];
    
            return view('dashboard', $data);
        }
}