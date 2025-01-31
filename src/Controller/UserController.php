<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(UserRepository $userRepository): JsonResponse
    {
        $users = $userRepository->findAll();
        return $this->json($users);
    }

    #[Route('/user/{id}', name: 'app_user_show')]
    public function show(int $id): JsonResponse
    {

    }

    #[Route('/user', name: 'app_user_store', methods: ['POST'])]
    public function store(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator): JsonResponse
    {
        try {
            $user = $serializer->deserialize($request->getContent(), User::class, 'json');
            $errors = $validator->validate($user);

            if (count($errors) > 0) {
                return new JsonResponse(['error' => (string)$errors], Response::HTTP_BAD_REQUEST);
            }
            $entityManager->persist($user);
            $entityManager->flush();
            $userData = [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'roles' => $user->getRoles(),
            ];

            return new JsonResponse($userData, Response::HTTP_CREATED);

        } catch (Exception $e) {
            return new JsonResponse(
                ['error' => $e->getMessage()],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    #[Route('/user/{id}', name: 'app_user_edit', methods: ['PUT'])]
    public function edit(int $id): JsonResponse
    {

    }

    #[Route('/user/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {

    }
}
