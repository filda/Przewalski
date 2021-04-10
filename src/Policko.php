<?php declare(strict_types=1);

namespace Horses;

class Policko {
    public int $x;
    public int $y;

    public function __construct(int $x, int $y) {
        $this->x = $x;
        $this->y = $y;
    }

    public function getKey():  string {
        return "{$this->x}:{$this->y}";
    }

}
