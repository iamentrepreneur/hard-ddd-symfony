<?php

declare(strict_types=1);

namespace App\Infrastructure\Http;

use App\Application\UseCase\CreateCompanyUseCase;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateCompanyController extends AbstractController
{
    private CreateCompanyUseCase $useCase;
    public function __construct(CreateCompanyUseCase $useCase)
    {
        $this->useCase = $useCase;
    }

    #[Route('/api/v1/company', name: 'api_company_add', methods: 'POST')]
    public function createCompany(): Response
    {
        $id = $this->useCase->execute();
        return $this->json(['id' => $id], Response::HTTP_CREATED);
    }
}
