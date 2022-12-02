<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tile;
use App\Repository\BoatRepository;
use App\Repository\TileRepository;
use App\Services\MapManager;
use Doctrine\ORM\Mapping\Id;

class MapController extends AbstractController
{
    /**
     * @Route("/map", name="map")
     */
    public function displayMap(BoatRepository $boatRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $tiles = $em->getRepository(Tile::class)->findAll();

        foreach ($tiles as $tile) {
            $map[$tile->getCoordX()][$tile->getCoordY()] = $tile;
        }

        $boat = $boatRepository->findOneBy([]);



        return $this->render('map/index.html.twig', [
            'map'  => $map ?? [],
            'boat' => $boat,
        ]);
    }

    /**
     * @Route("/start", name="start")
     */
    public function start(BoatRepository $boatRepository, MapManager $mapManager, TileRepository $tileRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $boat = $boatRepository->findOneBy([]);
        $tiles = $tileRepository->findAll();
        /* Reset the boat's coordinate to (0,0) */
        $boat->setCoordX(0)
        ->setCoordY(0);
        $em->flush();

        //remove the old treasure
        foreach ($tiles as $tile) {
            if($tile->getHasTreasure() === true) {
                $tile->setHasTreasure(false);
                $em->flush();
            }
        }
        
        //put the treasure on an island
        $randomIsland = $mapManager->getRandomIsland();
        
        //dd($randomIsland);
        $treasureIsland = $tileRepository->findOneBy(['id' => $randomIsland->getId()]);
        $treasureIsland->setHasTreasure(true);
        $em->flush();

        return $this->redirectToRoute('map');
    }
}
