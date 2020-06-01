<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Framework\Components\Request;
use App\Models\User;

class LoginController extends BaseController
{
    // $request get $_GET or $_POST
    protected $request;

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->request = new Request;
        $this->user = new User;
    }

    /**
     * Method login by email and password
     * if login success create $_SESSION
     */
    public function login()
    {
//        session_unset($_SESSION['login']);
//
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == "POST") {

            $request = $this->request->getRequestPost();
            $email = $request['email'];
            $password = $request['password'];
//            $password = $request['password'];
            $user = $this->user->where([
                'email' => $request['email'],
                'password' => md5($request['password']),
                'status' => 1
            ])->get();

            if (!is_null($user)) {
                $_SESSION['login'] = (array)$user;
                unset($user['password']);
                $this->remerberMe($email, $password);
                header("Location:index.php?controllers=Categories&&action=listCategories");
            }

        }
        $this->render('Login');

    }

    public function remerberMe($email, $password)
    {
        if (isset($this->checkCookie)) {
            $this->createCokie($email, $password);

        } else {
            $this->destroyCookie($email, $password);
        }

    }

    /**
     * Method create Cokie
     */
    public function createCokie()
    {
        setcookie('email', $this->request->getRequestPost('email'), time() + 8400);
        setcookie('password', $this->request->getRequestPost('password'), time() + 8400);
    }

    public function destroyCookie()
    {
        setcookie('email', $this->request->getRequestPost('email'), time() - 8400);
        setcookie('password', $this->request->getRequestPost('password'), time() - 8400);
    }

    public function checkCookie()
    {
        return isset($_POST['rememberme']);
    }

    public function logout()
    {
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }
        header("Location:index.php");
    }

}
