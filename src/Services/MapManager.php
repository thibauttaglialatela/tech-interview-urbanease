<?php
namespace App\Services;

class MapManager
{
    public function tileExists(int $x, int $y): bool
    {
        if ($x >= 0 || $x <= 11 && ($y >= 0 || $y <= 11)) {
            return true;
        } else {
            return false;
        }
    }
}