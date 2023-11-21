<?php

namespace App\Controllers\Admin;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\Shield\Authentication\Passwords;
use CodeIgniter\Shield\Entities\User;

class ManajemenUserAdmin extends BaseController
{
	protected $userModel;
	protected $helpers = ['form'];
	protected $faker;
	private array $tables;

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

		/** @var Auth $authConfig */
		$authConfig   = config('Auth');
		$this->tables = $authConfig->tables;
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

	public function tambahUser()
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		return view('admin/formtambahuser.php', $this->data);
	}

	public function saveTambahUser()
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		// $users = new UserModel();
		$users = auth()->getProvider();

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = $this->getValidationRules();

		if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$user = new User([
			'username' => $this->request->getVar('username'),
			'email'    => $this->request->getVar('email'),
			'password' => $this->request->getVar('password'),
		]);

		$users->save($user);

		// To get the complete user object with ID, we need to get from the database
		$user = $users->findById($users->getInsertID());

		// Add to group
		$user->syncGroups($this->request->getVar('group'));


		$nama = [
			'id' => $users->getInsertID(),
			'first_name' => $this->request->getVar('first_name'),
			'last_name'    => $this->request->getVar('last_name'),
			'uuid' => $this->faker->uuid()
		];
		$this->userModel->save($nama);

		$user->activate();

		session()->setFlashdata('sukses', 'User berhasil ditambahkan.');

		return redirect()->to('/DashboardAdmin/manajemen-user');
	}

	// form update artikel
	public function updateUser($uuid = null)
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		if ($uuid == null) $uuid = $this->request->getVar('uuid');

		// $user = $users->findByIdForEdit($uuid);
		$user = $this->userModel->findByIdForEdit($uuid);
		$this->data['user'] = $user;
		$this->data['uuid'] = $uuid;
		// d($this->userModel->findAll());
		// d($this->userModel->findByIdForEdit($uuid));
		// dd($this->userModel->findAllButAdmins());

		return view('admin/formedituser.php', $this->data);
	}

	public function saveUpdateUser($id = null)
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		$users = auth()->getProvider();

		$usernameLama = $this->request->getVar('username_old');
		$emailLama = $this->request->getVar('email_old');

		$usernameLama == $this->request->getVar('username') ? $usernameRules = 'required' : $usernameRules = 'required|is_unique[users.username]';
		$emailLama == $this->request->getVar('email') ? $emailRules = 'required' : $emailRules = 'required|is_unique[auth_identities.secret]';

		// Validate here first, since some things,
		// like the password, can only be validated properly here.
		$rules = $this->getValidationRulesForUpdate($usernameRules, $emailRules);

		// if (!$this->validateData($this->request->getPost(), $rules, [], config('Auth')->DBGroup)) {
		// 	return redirect()->to('DashboardAdmin/update-user')->withInput()->with('errors', $this->validator->getErrors());
		// }
		if (!$this->validate($rules)) {
			// return redirect()->to('DashboardAdmin/update-user/' . $this->request->getVar('id'))->withInput();
			return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
		}

		$id = $this->request->getVar('id');

		$user = new User([
			'id' => $id,
			'username' => $this->request->getVar('username'),
			'email'    => $this->request->getVar('email'),
			'first_name' => $this->request->getVar('first_name'),
			'last_name'    => $this->request->getVar('last_name'),
			// 'password' => $this->request->getVar('password'),
		]);
		$users->save($user);

		$user = $users->findById($id);
		$user->syncGroups($this->request->getVar('group'));

		$nama = [
			'id' => $id,
			'first_name' => $this->request->getVar('first_name'),
			'last_name'    => $this->request->getVar('last_name'),
		];
		$this->userModel->save($nama);

		return redirect()->to('/DashboardAdmin/manajemen-user');
	}

	public function deleteUser($id)
	{
		$this->data['current_page'] = 'adminmanajemenuser';
		// Get the User Provider (UserModel by default)
		$users = auth()->getProvider();

		// To get the complete user object with ID, we need to get from the database
		// $user = $users->findById($this->request->getVar('id'));
		$user = $users->findById($id);

		$users->delete($user->id, true);
		return redirect()->to('/DashboardAdmin/manajemen-user');
	}

	protected function getValidationRules(): array
	{
		$registrationUsernameRules = array_merge(
			config('AuthSession')->usernameValidationRules,
			[sprintf('is_unique[%s.username]', $this->tables['users'])]
		);
		$registrationEmailRules = array_merge(
			config('AuthSession')->emailValidationRules,
			[sprintf('is_unique[%s.secret]', $this->tables['identities'])]
		);

		return setting('Validation.registration') ?? [
			'username' => [
				'label' => 'Auth.username',
				'rules' => $registrationUsernameRules,
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah ada'
				]
			],
			'email' => [
				'label' => 'Auth.email',
				'rules' => $registrationEmailRules,
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah ada'
				]
			],
			'password' => [
				'label'  => 'Auth.password',
				'rules'  => 'required|' . Passwords::getMaxLengthRule() . '|strong_password[]',
				'errors' => [
					'max_byte' => 'Auth.errorPasswordTooLongBytes',
				],
			],
			'password_confirm' => [
				'label' => 'Auth.passwordConfirm',
				'rules' => 'required|matches[password]',
			],
		];
	}
	protected function getValidationRulesForUpdate($usernameRules, $emailRules): array
	{
		return setting('Validation.registration') ?? [
			'username' => [
				'label' => 'Auth.username',
				'rules' => $usernameRules,
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah ada'
				]
			],
			'email' => [
				'label' => 'Auth.email',
				'rules' => $emailRules,
				'errors' => [
					'required' => '{field} harus diisi',
					'is_unique' => '{field} sudah ada'
				]
			],
			// 'password' => [
			// 	'label'  => 'Auth.password',
			// 	'rules'  => 'required|' . Passwords::getMaxLengthRule() . '|strong_password[]',
			// 	'errors' => [
			// 		'max_byte' => 'Auth.errorPasswordTooLongBytes',
			// 	],
			// ],
			// 'password_confirm' => [
			// 	'label' => 'Auth.passwordConfirm',
			// 	'rules' => 'required|matches[password]',
			// ],
		];
	}
}
