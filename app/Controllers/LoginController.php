<?php

namespace App\Controllers;

use CodeIgniter\Shield\Controllers\LoginController as ShieldLogin;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class LoginController extends ShieldLogin
{

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		parent::initController($request, $response, $logger);

        $this->data['judul_halaman'] = 'Rilis Media | Pusat Desain Industri Nasional';
		$this->data['current_page'] = 'rilismedia';

        // dd($this->data);

	}

    public function index() {
        $this->data['current_page'] = 'login';
        return view('Shield/login.php', $this->data);
    }

    public function loginView()
    {
        dd("AAAAAAAAAAAAAA");
        if (auth()->loggedIn()) {
            return redirect()->to(config('Auth')->loginRedirect());
        }

        /** @var Session $authenticator */
        $authenticator = auth('session')->getAuthenticator();

        // If an action has been defined, start it up.
        if ($authenticator->hasAction()) {
            return redirect()->route('auth-action-show');
        }


        return $this->view(setting('Auth.views')['login']);
    }
}