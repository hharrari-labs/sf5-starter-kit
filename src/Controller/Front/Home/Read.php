<?php

namespace App\Controller\Front\Home;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Read extends AbstractController
{
    /**
     * @Route("/", name="home_index")
     * @return Response
     */
    public function read(): Response
    {
        return $this->render("home/index.html.twig");
    }
}
