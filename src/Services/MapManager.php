<?php

namespace App\Services;

use App\Entity\Tile;
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

    public function getRandomIsland()
    {
        $tiles = $this->getDoctrine()->getRepository(Tile::class)->findAll();
        $islandArray = [];
        foreach ($tiles as $tile) {
            if ($tile->getType() === 'island') {
                array_push($islandArray, $tile);
            }
        }

        return $islandArray[array_rand($islandArray)];
    }
}
