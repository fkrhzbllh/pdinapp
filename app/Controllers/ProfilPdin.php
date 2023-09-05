<?php

namespace App\Controllers;

class ProfilPdin extends BaseController
{
	public function index()
	{
		$this->data['judul_halaman'] = 'Profil | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'profil';

		return view('main/profil/profil-pdin.php', $this->data);
	}
}
