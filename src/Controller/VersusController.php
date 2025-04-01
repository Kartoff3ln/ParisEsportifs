<?php

namespace App\Controller;

use App\Entity\Versus;
use App\Entity\Bet;
use App\Entity\Team;
use App\Form\VersusType;
use App\Repository\VersusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/versus')]
class VersusController extends AbstractController
{
    #[Route('/', name: 'app_versus_index', methods: ['GET'])]
    public function index(VersusRepository $versusRepository): Response
    {
        return $this->render('versus/index.html.twig', [
            'versuses' => $versusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_versus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $versu = new Versus();
        $form = $this->createForm(VersusType::class, $versu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($versu);
            $entityManager->flush();

            return $this->redirectToRoute('app_versus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('versus/new.html.twig', [
            'versu' => $versu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_versus_show', methods: ['GET'])]
    public function show(Versus $versu): Response
    {
        return $this->render('versus/show.html.twig', [
            'versu' => $versu,
        ]);
    }

    #[Route('/{id}/valid', name: 'app_versus_valid', methods: ['GET'])]
    public function versusValid(Versus $versu, $id): Response
    {
        return $this->render('versus/valid.html.twig', [
            'versu' => $versu,
        ]);
    }

    #[Route('/{id}/validbet/{team}', name: 'app_versus_valid_bet', methods: ['GET'])]
    public function versusValidBet(Versus $versu, EntityManagerInterface $entityManager, $id, $team): Response
    {
        $winnerTeam = ($team == 'team1') ? $versu->getTeam1() : $versu->getTeam2();

        if ($winnerTeam instanceof Team) {
            $versu->setWinner($winnerTeam);

            $rate = ($team == 'team1') ? $versu->getRateTeam1() : $versu->getRateTeam2();

            $bets = $entityManager->getRepository(Bet::class)->findBy([
                'teamid' => $winnerTeam->getId(),
                'versusid' => $versu->getId(),
            ]);

            foreach ($bets as $bet) {
                $userBalanceUpdate = $bet->getAmount() * $rate;
                $bet->getUserid()->setBalance($bet->getUserid()->getBalance() + $userBalanceUpdate);
                $entityManager->persist($bet->getUserid());
            }

            $entityManager->flush();
        }

        return $this->redirectToRoute('app_versus_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'app_versus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Versus $versu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VersusType::class, $versu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_versus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('versus/edit.html.twig', [
            'versu' => $versu,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_versus_delete', methods: ['POST'])]
    public function delete(Request $request, Versus $versu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$versu->getId(), $request->request->get('_token'))) {
            $entityManager->remove($versu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_versus_index', [], Response::HTTP_SEE_OTHER);
    }
}
