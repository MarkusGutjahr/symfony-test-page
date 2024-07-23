<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddContactController extends AbstractController
{

    #[Route('/add', name:'app_add_contact')]
    public function addContactAction(Request $request): Response
    {







        return $this->render('addContact.html.twig');
    }
}