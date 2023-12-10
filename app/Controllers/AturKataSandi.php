<?php

namespace App\Controllers;

use CodeIgniter\Shield\Authentication\Passwords;

class AturKataSandi extends BaseController
{
    public function index()
    {
        // Jika session magicLogin tidak berlaku, maka kembali ke dasbor
        if (!session('magicLogin')) {
            // Kembali ke dasbor
            $url = auth()->user()->inGroup('admin') ? '/DashboardAdmin' : '/dashboard-user';
            return redirect()->to($url);
        }
        return view('atur-kata-sandi', $this->data);
    }

    public function aturPassword()
    {
        $rules = $this->getValidationRules();

        // Cek validasi
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $users = auth()->getProvider();

        $user = $users->findById(auth()->id());
        $user->fill([
            'password' => $this->request->getVar('password')
        ]);
        $users->save($user);

        session()->removeTempdata('magicLogin'); // Hapus session magic login

        // Kembali ke dasbor
        $url = auth()->user()->inGroup('admin') ? '/DashboardAdmin' : '/dashboard-user';
        return redirect()->to($url);
    }

    public function kembaliKeDasbor()
    {
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
}
