<?php

namespace App\Services;

use App\Entity\Tile;
use App\Repository\TileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MapManager extends AbstractController
{


    public function tileExists(int $x, int $y): bool
    {
        $tile = $this->getDoctrine()->getRepository(Tile::class)->findOneBy(['coordX' => $x, 'coordY' => $y]);

        if ($tile) {
            return true;
        } else {
            return false;
        }
    }

    public function getRandomIsland(TileRepository $tileRepository)
    {
        $tiles = $tileRepository->findAll();
        $islandArray = [];
        foreach ($tiles as $tile) {
            if ($tile->getType() === 'island') {
                array_push($islandArray, $tile);
            }
        }

        return array_rand($islandArray);
    }
}
