<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DetailsController extends AbstractController
{
    #[Route('/details', name:'app_details')]
    public function addContactAction(Request $request): Response
    {
        return $this->render('details.html.twig');
    }
}