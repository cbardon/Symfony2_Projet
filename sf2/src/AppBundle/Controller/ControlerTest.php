<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ControlerTest extends Controller
{

    public function indexAction($name)
    {
        return new reponse('<html><body>Salut mon gars ! '.$name.' !</body></html>');
    }
}
