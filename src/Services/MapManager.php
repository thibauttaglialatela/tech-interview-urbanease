<?php
namespace App\Services;

use App\Repository\TileRepository;

class MapManager
{
    public function tileExists(TileRepository $tileRepository): bool
    {
        /* $tile = $tileRepository->findOneBy([]);

        if ($tile->getCoordX() >= 0 || $tile->getCoordX() <= 11 && ($tile->getCoordY() >= 0 || $tile->getCoordY() <= 11)) {
            return true;
        } else {
            return false;
        } */
    }
}