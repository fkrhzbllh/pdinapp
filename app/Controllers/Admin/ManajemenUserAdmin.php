<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Controllers\BaseController;

class ManajemenUserAdmin extends BaseController
{
	protected $userModel;
	protected $helpers = ['form'];
	protected $faker;

	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

		$this->userModel = new UserModel();
		$this->helpers = ['form'];
		$this->data['judul_halaman'] = 'Admin | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'adminmanajemenuser';
		$this->data['admin'] = true;
		date_default_timezone_set('Asia/Jakarta');
		$this->faker = \Faker\Factory::create();
	}

	public function index()
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		$this->data['user'] = $this->userModel->findAllButAdmins();
		return view('admin/adminmanajemenuser.php', $this->data);
	}

	public function user()
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		$this->data['user'] = $this->userModel->findAllButAdmins();
		return view('admin/adminmanajemenuser.php', $this->data);
	}
}
