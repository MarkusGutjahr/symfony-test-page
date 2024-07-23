<?php
namespace App\Controller;

use App\Form\Type\ContactBookType;
use App\Repository\ContactBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController{

    public function __construct (private readonly int $limit, private readonly ContactBookRepository $repository)
    {

    }

    #[Route('/', name: 'index')]
    public function indexAction(Request $request): Response
    {
        $form = $this->createForm(ContactBookType::class);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $data = $form->getData();

            //Daten Zwischenspeichern
            $this->repository->add($data);
            //Daten in DB speichern
            $this->repository->flush();

            //popup message
            $this->addFlash('success', 'Erfolgreich gespeichert!');


            //auf Startseite zurückleiten (nach submit)
            return $this->redirectToRoute('index');

            //dump($data);
        }

        //Limit für angezeigte Einträge ($limit als Environment Variable)
        $maxPages = $this->getMaxPages($this->limit);
        $currentPage = $this->getCurrentPage($request, $maxPages);

        $entries = $this->repository->getPaginatedEntries($this->limit, $currentPage);
        //dd($entries);

        return $this->render('index.html.twig', [
            'contactBookForm' => $form,
            'entries' => $entries,
            'maxPages' => $maxPages,
            'currentPage' => $currentPage,
        ]);
    }

    private function getMaxPages(int $limit): int {
        $totalEntries = $this->repository->count([]);
        return (int)ceil($totalEntries / $limit);
    }

    private function getCurrentPage(Request $request, int $maxPages): int {
        //Nummer der Page aus URL auslesen oder 1 zurückgeben
        $page = (int)$request->get('page', 1);
        //return page Nummer die mindestens 1 ist, aber unter maxPages
        return min(max($page, 1), $maxPages);
    }

}
