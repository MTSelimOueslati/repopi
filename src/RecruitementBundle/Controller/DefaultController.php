<?php

namespace RecruitementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RecruitementBundle:Default:index.html.twig');
    }
}
