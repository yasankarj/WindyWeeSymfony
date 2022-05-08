<?php

namespace App\Controller;


use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Bridge\Symfony\Routing\IriConverter;
use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="app_homepage")
     */
    public function index(): Response
    {
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route("/category/{id}", name="app_category")
     * @param Category $category
     * @param IriConverterInterface $iriConverter
     * @return Response
     */
    public function showCategory(Category $category, IriConverterInterface $iriConverter): Response
    {
        return $this->render('product/index.html.twig', [
            'currentCategoryId' => $category->getId()
        ]);
    }

    /**
     * @Route("/product/{id}", name="app_product")
     */
    public function showProduct(Product $product): Response
    {
        return $this->render('product/index.html.twig');
    }
}
