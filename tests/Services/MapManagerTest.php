<?php
namespace App\Tests\Services;

use App\Services\MapManager;
use PHPUnit\Framework\TestCase;

class MapManagerTest extends TestCase
{
    private $mapManager;

    public function __construct(MapManager $mapManager)
    {
        $this->mapManager = $mapManager;
    }

    
    public function testTilesExist(): void
    {
        $this->assertEquals(true, $this->mapManager->tileExists(4,5));
        $this->assertEquals(true, $this->mapManager->tileExists(0,10));
        $this->assertEquals(false, $this->mapManager->tileExists(-5,5));
        $this->assertEquals(false, $this->mapManager->tileExists(3,15));
    }
}