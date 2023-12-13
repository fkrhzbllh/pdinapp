<?php

namespace App\Controllers;


use CodeIgniter\HTTP\RedirectResponse;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenyewaModel;
use App\Models\PesertaPelatihanModel;
use App\Models\UserModel;
use CodeIgniter\Shield\Authentication\Passwords;
use CodeIgniter\Shield\Entities\User;
use Config\Auth;

class AturProfil extends BaseController
{
    /**
     * Auth Table names
     */
    private array $tables;
    protected $penyewaModel;
    protected $pesertaModel;
    protected $userModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ): void {
        parent::initController(
            $request,
            $response,
            $logger
        );

        /** @var Auth $authConfig */
        $authConfig   = config('Auth');
        $this->tables = $authConfig->tables;

        $this->penyewaModel = new PenyewaModel();
        $this->pesertaModel = new PesertaPelatihanModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Apabila sukses mengubah profil, kembali ke dasbor user
        if (session()->getFlashdata('sukses')) {
            $url = '/dashboard-user';
            header("Refresh:1;url=" . $url);
        }

        return view('atur-profil', $this->data);
    }

    public function aturProfil()
    {
        $rules = $this->getValidationRules();

        // Cek validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Update email, nama depan, dan nama belakang
        $users = $this->userModel;
        $user = [
            'id' => auth()->id(),
            'email'    => $this->request->getVar('email'),
            'first_name' => $this->request->getVar('first_name'),
            'last_name'    => $this->request->getVar('last_name'),
            // 'password' => $this->request->getVar('password'),
        ];
        $users->save($user);

        //Ganti email penyewa
        $penyewa = $this->penyewaModel->where('id_user', auth()->id())->first();
        if ($penyewa) {
            $this->penyewaModel->save([
                'id' => $penyewa['id'],
                'email' => $this->request->getVar('email'),
            ]);
        }

        // Ganti email peserta
        $peserta = $this->pesertaModel->where('id_user', auth()->id())->first();
        if ($peserta) {
            $this->pesertaModel->save([
                'id' => $peserta['id'],
                'email' => $this->request->getVar('email'),
            ]);
        }

        // Kembali dan kirim pesan sukses
        return redirect()->back()->with('sukses', lang('Profile.editSuccess'));
    }

    public function aturPassword()
    {
        $rules = $this->getPasswordValidationRules();

        // Cek validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Get user
        $users = auth()->getProvider();
        $user = $users->findById(auth()->id());

        /** @var Passwords $passwords */
        $passwords = service('passwords');
        $givenPassword = $this->request->getVar('old_password');

        // Now, try matching the passwords.
        if (!$passwords->verify($givenPassword, $user->password_hash)) {
            return redirect()->back()->withInput()->with('errors', lang('Auth.invalidPassword'));
        }

        // Jika password lama benar, ganti password
        $user->fill([
            'password' => $this->request->getVar('password')
        ]);
        $users->save($user);

        // Kembali dan kirim pesan sukses
        return redirect()->back()->with('sukses', lang('Profile.passwordChangeSuccess'));
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getPasswordValidationRules(): array
    {
        return [
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

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
    protected function getValidationRules(): array
    {
        return [
            'first_name' => [
                'label' => 'Nama Depan',
                'rules' => 'alpha_space',
            ],
            'last_name' => [
                'label' => 'Nama Belakang',
                'rules' => 'alpha_space',
            ],
            'email' => [
                'label' => 'Auth.email',
                'rules' => 'valid_email',
            ]
        ];
    }
}
