<?php

namespace App\Controller;

use App\DTO\CompanyDto;
use App\Entity\Company;
use App\Form\CompanyHistoricType;
use App\Services\CompanyService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{

    /**
     * @Route("/add", name="company_add", methods={"GET", "POST"})
     */
    public function add(Request $request, CompanyService $companyService): Response {
        $companyDto = new CompanyDto();
        $form = $this->createForm(CompanyHistoricType::class, $companyDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyId = $companyService->addCompany($companyDto);

            return $this->redirectToRoute('company_show', ['id' => $companyId]);
        }

        return $this->render('company/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/show/{id}", name="company_show", methods={"GET"})
     */
    public function show(Company $company, Request $request, CompanyService $companyService): Response {
        $date = null;
        if ($request->get('date')) {
            $date = new DateTime($request->get('date'));
        }

        $companyHistory = $companyService->getCompanyInformation($company, $date);

        return $this->render('company/show.html.twig', [
            'company' => $companyHistory
        ]);
    }

    /**
     * @Route("/update/{id}", name="company_update", methods={"GET", "POST"})
     */
    public function update(Company $company, Request $request, CompanyService $companyService): Response {
        $companyHistory = $companyService->getCompanyInformation($company);
        $companyDto = CompanyDto::fromHistory($companyHistory);

        $form = $this->createForm(CompanyHistoricType::class, $companyDto, [ 'is_edit' => true]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $companyService->updateCompany($companyHistory, $companyDto);

            return $this->redirectToRoute('company_show', ['id' => $company->getId()]);
        }

        return $this->render('company/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
}