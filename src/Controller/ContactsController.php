<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ContactRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactsController extends AbstractController
{
    #[Route('/contacts', name: 'app_contacts')]
    public function showContacts(Request $request, ContactRepository $contactRepository, PaginatorInterface $paginator): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException('You must be logged in to view contacts.');
        }

        $queryBuilder = $contactRepository->createQueryBuilder('c')
            ->where('c.user = :user')
            ->setParameter('user', $user);

        $pagination = $paginator->paginate(
            $queryBuilder->getQuery(),
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('contacts.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/contacts/delete', name: 'app_contacts_delete', methods: ['POST'])]
    public function deleteContact(Request $request, ContactRepository $contactRepository): Response
    {
        $contactId = $request->request->get('delete');
        $contact = $contactRepository->find($contactId);

        if ($contact && $contact->getUser() === $this->getUser()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('app_contacts');
    }

}


