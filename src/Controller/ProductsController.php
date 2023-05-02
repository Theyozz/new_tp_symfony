<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    #[Route('/products', name: 'products_list')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findBy(['visible' => true]);
        return $this->render('products/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/products/{id}', name: 'product_item')]
    public function item(Product $product): Response
    {
        return $this->render('products/item.html.twig', [
            'product' => $product
        ]); 
    }
}
