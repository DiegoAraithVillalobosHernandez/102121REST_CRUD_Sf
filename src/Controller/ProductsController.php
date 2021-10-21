<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function findAllProducts(){
        $em = $this->getDoctrine()->getManager();//instanciando la bd

        $query = $em->createQuery('Select p.idproduct, p.name, p.precio, p.status FROM App:Products p');
        $listProducts = $query->getResult();

        $data = [
            'status' => 200,
            'message' => 'No se encontraron resultados.',
        ];

        if(count($listProducts) > 0){
            $data = [
                'status' => 200,
                'message' => 'Se encontraron ' . count($listProducts) . ' resultados.',
                'listProducts' => $listProducts
            ];
        }
        return new JsonResponse($data);

    }
}
