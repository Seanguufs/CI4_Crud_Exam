<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    protected $request;

    protected $helpers = ['cookie', 'date', 'security', 'menu', 'useraccess'];

    protected $session, $segment, $validation, $encrypter, $ApplicationModel, $db, $data = [];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->session          = service('session');
        $this->segment          = service('uri');
        $this->validation       = \Config\Services::validation();
        $this->encrypter        = \Config\Services::encrypter();
        $this->ApplicationModel = new ApplicationModel();
        $this->db               = \Config\Database::connect();

        $sessionUser = session('user');
        if ($sessionUser) {
            $user = $this->ApplicationModel->getUser(username: $sessionUser['username'] ?? $sessionUser['email'] ?? '');
            if ($user && isset($sessionUser['role'])) {
                $user['role_slug'] = $sessionUser['role'];
            }
        } else {
            $user = $this->ApplicationModel->getUser(username: session()->get('username'));
        }

        $segment    = $this->segment->getSegment(1);
        $subsegment = $segment ? $this->segment->getSegment(2) : '';

        $this->data = [
            'segment'      => $segment,
            'subsegment'   => $subsegment,
            'user'         => $user,
            'MenuCategory' => $this->ApplicationModel->getAccessMenuCategory(session()->get('role') ?? 1),
        ];
    }
}
