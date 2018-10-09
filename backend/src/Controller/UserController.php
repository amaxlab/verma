<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class UserController extends Controller
{
    /**
     * @Route("/login_check", name="api_login_check")
     */
    public function loginAction()
    {
    }
}
