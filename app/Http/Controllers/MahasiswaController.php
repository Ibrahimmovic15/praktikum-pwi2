<?php

namespace App\Http\Controllers;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = [
            'Ibrahim',
            'Hanni',
            'Haerin',
            'Minji',
        ];

        return view('pages.mahasiswa', [
            'mahasiswa' => $mahasiswa,
        ]);
    }
}