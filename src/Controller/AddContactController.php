<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AddContactController extends AbstractController
{
    #[Route('/add', name: 'app_add_contact')]
    public function addContactAction(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            if ($user instanceof User) {
                $contact->setUser($user);

                $em->persist($contact);
                $em->flush();

                $this->addFlash('success', 'Contact ' . $contact->getName() . ' was added to your list');

                return $this->redirectToRoute('app_contacts');
            } else {
                $this->addFlash('error', 'User not authenticated');
                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('addContact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}