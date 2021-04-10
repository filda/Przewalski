<?php declare(strict_types=1);

namespace Test;

use Horses\Przewalski;
use Horses\Policko;
use PHPUnit\Framework\TestCase;

class PrzewalskiTest extends TestCase {

    public function testOneStep(): void {
        $przewalski = new Przewalski();
        $a = new Policko(1, 1);
        $b = new Policko(3, 2);
        $path = $przewalski->nejkratsiCestaKone($a, $b);
        $expected = [
            new Policko(1, 1),
            new Policko(3, 2),
        ];
        $this->assertEquals($expected, $path);
    }

    public function testTwoSteps(): void {
        $przewalski = new Przewalski();
        $a = new Policko(1, 1);
        $b = new Policko(5, 3);
        $path = $przewalski->nejkratsiCestaKone($a, $b);
        $expected = [
            new Policko(1, 1),
            new Policko(3, 2),
            new Policko(5, 3),
        ];

        $this->assertEquals($expected, $path);
    }

    public function testDiagonal(): void {
        $przewalski = new Przewalski();
        $a = new Policko(1, 1);
        $b = new Policko(8, 8);
        $path = $przewalski->nejkratsiCestaKone($a, $b);
        $expected = [
            new Policko(1, 1),
            new Policko(2, 3),
            new Policko(1, 5),
            new Policko(2, 7),
            new Policko(4, 8),
            new Policko(6, 7),
            new Policko(8, 8),
        ];

        $this->assertEquals($expected, $path);
    }

    public function testBackwards(): void {
        $przewalski = new Przewalski();
        $a = new Policko(6, 6);
        $b = new Policko(5, 2);
        $path = $przewalski->nejkratsiCestaKone($a, $b);
        $expected = [
            new Policko(6, 6),
            new Policko(4, 5),
            new Policko(3, 3),
            new Policko(5, 2),
        ];

        $this->assertEquals($expected, $path);
    }
}
