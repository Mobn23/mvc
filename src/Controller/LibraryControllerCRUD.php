<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository; //this mapping between Book entity class (The line before it) and the service provided by Doctrine that helps to interact with the database (The line after it).
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class LibraryControllerCRUD extends AbstractController
{
    /**
     * Route('/book/create', name: 'book_create', methods:['POST'])
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return HTTP Response
     */
    #[Route('/book/create', name: 'book_create', methods:['POST'])]
    public function createBook(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        if ($request->isMethod('POST')) {
            $bookName = $request->request->get('bookName');
            $author = $request->request->get('authorName');
            $entityManager = $doctrine->getManager();
            $newId = $entityManager->getRepository(Book::class)->getMaxId() + 1; //Maniually Auto increment cause database is not monitoring the correct autoincrement after deleting books.

            $book = new Book();
            $book->setName($bookName);
            $book->setId($newId);
            $book->setAuthor($author);

            // tell Doctrine you want to (eventually) save the Book
            // (no queries yet)
            $entityManager->persist($book);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->redirectToRoute('books_show_all');
        }
    }

    /**
     * Route('/book/show', name: 'book_show_by_id', methods:['GET', 'POST'])
     * @param BookRepository $bookRepository
     * @param Request $request
     * @return HTTP Response
     */
    #[Route('/book/show', name: 'book_show_by_id', methods:['GET', 'POST'])]
    public function showBookById(
        BookRepository $bookRepository,
        Request $request,
    ): Response {
        $id = $request->query->get('bookId');
        $book = $bookRepository
            ->find($id);
        $baseURL = $request->getBasePath(); // Get the base URL of the application
        $projectDir = $this->getParameter('kernel.project_dir');
        // the images are stored in the 'public/img' directory and named corresponding the books IDs.
        $imagePath = '/img/' . $book->getId() . '.jpg';

        if (file_exists($projectDir . '/public' . $imagePath)) {
            $book->setImage($baseURL . $imagePath);
        }
        $data = [
            'book' => $book,
        ];

        return $this->render('library/crud-buttons/book.show.id.twig', $data);
    }

    /**
     * Route('/books/show', name: 'books_show_all')
     * @param BookRepository $bookRepository
     * @param Request $request
     * @return HTTP Response
     */
    #[Route('/books/show', name: 'books_show_all')]
    public function showAllBooks(
        BookRepository $bookRepository,
        Request $request
    ): Response {
        $books = $bookRepository
            ->findAll();
        $baseURL = $request->getBasePath(); // Get the base URL of the application
        foreach ($books as $book) {
            $projectDir = $this->getParameter('kernel.project_dir');
            // the images are stored in the 'public/img' directory and named corresponding the books IDs.
            $imagePath = '/img/' . $book->getId() . '.jpg';
            
            if (file_exists($projectDir . '/public' . $imagePath)) {
                $book->setImage($baseURL . $imagePath);
            }
        }
        $data = ["books" => $books];
        return $this->render('library/index.html.twig', $data);
    }

    /**
     * Route('/book/update', name: 'book_update', methods:['POST'])
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return HTTP Response
     */
    #[Route('/book/update', name: 'book_update', methods:['POST'])]
    public function updateBook(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        $id = $request->request->get('bookId');
        $bookName = $request->request->get('bookName');
        $authorName = $request->request->get('authorName');
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $book->setName($bookName);
        $book->setAuthor($authorName);
        $entityManager->flush();

        return $this->redirectToRoute('books_show_all');
    }

    /**
     * Route('/book/delete', name: 'book_delete')
     * @param ManagerRegistry $doctrine
     * @param Request $request
     * @return HTTP Response
     */
    #[Route('/book/delete', name: 'book_delete')]
    public function deleteBookById(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $id = $request->request->get('bookId');
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('books_show_all');
    }
}
