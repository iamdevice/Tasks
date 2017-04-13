<?php
/**
 * Aleksandr Kozhevnikov <iamdevice@gmail.com>
 * Date: 14.04.17 14:42
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function logoutAction()
    {
        if ($this->getUser()) {
            $this->get('security.token_storage')->setToken(null);

            return $this->redirectToRoute('homepage');
        }
    }
}
