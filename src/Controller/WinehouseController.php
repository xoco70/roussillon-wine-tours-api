<?php

namespace App\Controller;

use App\Entity\Winehouse;
use App\Entity\Winemaker;
use App\Entity\WineSource;
use App\Repository\WinemakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class WinehouseController extends AbstractController
{
    private $em;
    private $serializer;
    private $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        SerializerInterface    $serializer,
        ValidatorInterface     $validator
    )
    {
        $this->em = $entityManager;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    #[Route('/winehouses', name: 'app_winehouse', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $winehouses = $this->em->getRepository(Winehouse::class)->findAll();
        return $this->json($winehouses);

    }

    #[Route('/winehouse', name: 'create_winehouse', methods: ['POST'])]
    public function createWinehouse(Request $request, WinemakerRepository $winemakerRepository): Response
    {
        $data = $request->getContent();
        try {
            $winehouse = $this->serializer->deserialize($data, Winehouse::class, 'json');//            // Valider l'entité
            $errors = $this->validator->validate($winehouse);
            if (count($errors) > 0) {
                return new Response((string)$errors, Response::HTTP_BAD_REQUEST);
            }
            // Vérifier si le winemaker existe
            $winemakerId = $winehouse->getWinemaker()->getId();
            $winemaker = $winemakerRepository->find($winemakerId);
            if (!$winemaker) {
                return new Response("Winemaker not found", Response::HTTP_BAD_REQUEST);
            }

            // Associer le winemaker et persister l'entité
            $winehouse->setWinemaker($winemaker);
            $this->em->persist($winehouse);
            $this->em->persist($winemaker);
            $this->em->flush();//
            //            // Retourner une réponse de succès
            return new Response(
                $this->serializer->serialize($winemaker, 'json'),
                Response::HTTP_CREATED,
                ['Content-Type' => 'application/json']
            );
        } catch (Exception $e) {
            return new Response(
                json_encode(['error' => $e->getMessage()]),
                Response::HTTP_INTERNAL_SERVER_ERROR,
                ['Content-Type' => 'application/json']
            );
        }
    }
}
