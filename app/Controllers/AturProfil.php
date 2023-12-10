<?php

namespace App\Controllers;


use CodeIgniter\HTTP\RedirectResponse;
use Psr\Log\LoggerInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AturProfil extends BaseController
{
    /**
     * Auth Table names
     */
    private array $tables;

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
    }

    public function index()
    {
        return view('atur-profil', $this->data);
    }

    public function aturProfil()
    {
        $rules = $this->getValidationRules();

        // Cek validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = auth()->getProvider();

        $user = $users->findById(auth()->id());
        $user->fill([
            'first_name' => $this->request->getVar('first_name'),
            'last_name' => $this->request->getVar('last_name'),
            'email' => $this->request->getVar('email')
        ]);
        $users->save($user);

        // Kembali ke dasbor
        $url = auth()->user()->inGroup('admin') ? '/DashboardAdmin' : '/dashboard-user';
        return redirect()->to($url);
    }

    /**
     * Returns the rules that should be used for validation.
     *
     * @return array<string, array<string, array<string>|string>>
     * @phpstan-return array<string, array<string, string|list<string>>>
     */
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
                'rules' => $registrationEmailRules,
            ]
        ];
    }
}
