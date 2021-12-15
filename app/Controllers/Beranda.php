<?php

namespace App\Controllers;

class Beranda extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Desa Tegalreja'
    ];
    return view('beranda/beranda', $data);
  }
}
