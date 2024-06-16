<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository; //this mapping between Book entity class (The line before it) and the service provided by Doctrine that helps to interact with the database (The line after it).
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LibraryControllerTwig extends AbstractController
{
    #[Route('/library', name: 'app_library')]
    public function index(): Response //response here is the type of return
    {
        return $this->redirectToRoute('books_show_all');
    }

    #[Route('/create/book/form', name: 'create_book_form')]
    public function createBookForm(): Response
    {
        return $this->render('library/crud-buttons/create.book.form.twig');
    }

    #[Route('/update/book/form', name: 'update_book_form')]
    public function updateBookForm(): Response
    {
        return $this->render('library/crud-buttons/update.book.form.twig');
    }
}
