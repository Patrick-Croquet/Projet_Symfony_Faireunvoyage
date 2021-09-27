<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Header;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request)
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        $products = $this->entityManager->getRepository(product::class)->findall();

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(product::class)->findWithSearch($search);
        }

        return $this->render('product/index.html.twig', [
            'headers' => $headers,
            'title1' => 'Boutique',
            'title2' => 'Nos Produits Made in Réunion',
            'descriptif' => "Tout Les Produits Viennent De Nos Partenaires Se Trouvant Exclusivement Sur L'Ile De La Réunion.",
            'products' => $products,
            'form' => $form->createview()
        ]);
    }




    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug)
    {
        $headers = $this->entityManager->getRepository(Header::class)->findAll();

        $product = $this->entityManager->getRepository(product::class)->findOneBySlug($slug);
        $products = $this->entityManager->getRepository(Product::class)->findByIsBest(1);

        if (!$product) {
            return $this->redirectToRoute('products');
        }

        return $this->render('product/show.html.twig', [
            'headers' => $headers,
            'title' => 'Les Produits',
            'product' => $product,
            'products' => $products
        ]);
    }
}
