<?php

namespace App\Controllers;

class ProfilPdin extends BaseController
{
	public function index()
	{
		$this->data['judul_halaman'] = 'Profil | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'profil';

		$this->view('profilpdin.php', $this->data);
	}
}
