<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactsController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function showContacts(Request $request): Response
    {

        return $this->render('contacts.html.twig');
    }
}