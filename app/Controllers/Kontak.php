<?php

namespace App\Controllers;

class Kontak extends BaseController
{
	public function index()
	{
		$this->data['judul_halaman'] = 'Kontak | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'kontak';

		$this->view('kontak.php', $this->data);
	}
}
