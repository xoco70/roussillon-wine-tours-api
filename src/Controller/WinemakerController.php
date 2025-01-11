<?php

namespace App\Controller;

use App\Entity\Winemaker;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;



class WinemakerController extends AbstractController
{
    private $em;
    private $serializer;
    private $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface    $serializer,
        ValidatorInterface     $validator)
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }
    #[Route('/winemakers', name: 'app_winemaker')]
    public function index(): Response
    {
        return $this->json($this->em->getRepository(Winemaker::class)->findAllWithWinehouse(1));
//        return $this->render('winemaker/index.html.twig', [
//            'controller_name' => 'WinemakerController',
//        ]);
    }
}
