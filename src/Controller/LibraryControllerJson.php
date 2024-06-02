<?php

namespace App\Controller;

use App\Repository\BookRepository; //this mapping between Book entity class (The line before it) and the service provided by Doctrine that helps to interact with the database (The line after it).

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LibraryControllerJson extends AbstractController
{
    #[Route('/api/library/books', name: 'api_library_books')]
    public function showAllBooksJson(
        BookRepository $bookRepository,
    ): Response {
        $books = $bookRepository
            ->findAll();
        foreach ($books as $book) {
            $projectDir = $this->getParameter('kernel.project_dir');
            // the images are stored in the 'public/img' directory and named corresponding the books IDs.
            $imagePath = '/img/' . $book->getId() . '.jpg';
    
            if (file_exists($projectDir . '/public' . $imagePath)) {
                $book->setImage($imagePath);
            }
        }
        return $this->json($books);
    }

    #[Route('/api/library/book/{id}', name: 'api_library_book_id')]
    public function showOneBookJson(
        BookRepository $bookRepository,
        int $id = 1
    ): Response {
        $book = $bookRepository
            ->find($id);

        $projectDir = $this->getParameter('kernel.project_dir');
        // the images are stored in the 'public/img' directory and named corresponding the books IDs.
        $imagePath = '/img/' . $book->getId() . '.jpg';

        if (file_exists($projectDir . '/public' . $imagePath)) {
            $book->setImage($imagePath);
        }
        return $this->json($book);
    }
}
