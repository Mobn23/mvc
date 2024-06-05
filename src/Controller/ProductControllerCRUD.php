<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository; //this mapping between Product entity class (The line before it) and the service provided by Doctrine that helps to interact with the database (The line after it).
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductControllerCRUD extends AbstractController
{
    #[Route('/product/create', name: 'product_create')]
    public function createProduct(
        ManagerRegistry $doctrine
    ): Response {
        $entityManager = $doctrine->getManager();

        $product = new Product();
        $product->setName('Keyboard_num_' . rand(1, 9));
        $product->setValue(rand(100, 999));

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($product);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new product with id '.$product->getId());
    }

    #[Route('/product/show', name: 'product_show_all')]
    public function showAllProduct(
        ProductRepository $productRepository
    ): Response {
        $products = $productRepository
            ->findAll();

        // return $this->json($products);
        $response = $this->json($products);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT //this makes the code more tidy.
        );
        return $response;
    }

    #[Route('/product/show/{productId}', name: 'product_by_id')]
    public function showProductById(
        ProductRepository $productRepository,
        int $productId
    ): Response {
        $product = $productRepository
            ->find($productId);

        return $this->json($product);
    }

    #[Route('/product/delete/{productId}', name: 'product_delete_by_id')]
    public function deleteProductById(
        ManagerRegistry $doctrine,
        int $productId
    ): Response {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $entityManager->remove($product);
        $entityManager->flush();

        return $this->redirectToRoute('product_show_all');
    }

    #[Route('/product/update/{productId}/{value}', name: 'product_update')]
    public function updateProduct(
        ManagerRegistry $doctrine,
        int $productId,
        int $value
    ): Response {
        $entityManager = $doctrine->getManager();
        $product = $entityManager->getRepository(Product::class)->find($productId);

        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$productId
            );
        }

        $product->setValue($value);
        $entityManager->flush();

        return $this->redirectToRoute('product_show_all');
    }
}
