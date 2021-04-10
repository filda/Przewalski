<?php declare(strict_types=1);

namespace Horses;

class Przewalski {
    private array $possibleDirections = [
        [-2, 1],
        [-2, -1],
        [-1, 2],
        [-1, -2],
        [1, 2],
        [1, -2],
        [2, 1],
        [2, -1],
    ];
    private array $possiblePaths = [];
    private array $goal;
    private array $visited = [];


    /**
     * @return Policko[]
     */
    public function nejkratsiCestaKone(Policko $a, Policko $b): array {
        $this->possiblePaths[1][1] = $a;

        while (!$this->foundGoal($b)) {
            $this->possiblePaths = $this->getNextPossiblePaths($this->possiblePaths);
        }

        return $this->goal;
    }

    private function getNextPossiblePaths(array $possiblePaths): array {
        $nextPossiblePaths = [];
        foreach ($possiblePaths as $key => $row) {
            $possibleNextSteps = $this->getPossibleNextSteps($row[array_key_last($row)]);
            foreach ($possibleNextSteps as $step) {
                $nextPossiblePaths[] = array_merge($row, [$step]);
            }
        }

        return $nextPossiblePaths;
    }

    /**
     * @return Policko[]
     */
    private function getPossibleNextSteps(Policko $square): array {
        $possibleNextSteps = [];

        foreach ($this->possibleDirections as $direction) {
            $next = new Policko($square->x + $direction[0], $square->y + $direction[1]);

            if ($this->isOutOfBounds($next)) {
                continue;
            }

            if ($this->isAlreadyVisited($next)) {
                continue;
            }

            $possibleNextSteps[] = $next;
            $this->visited[] = $next->getKey();
        }

        return $possibleNextSteps;
    }


    private function isOutOfBounds(Policko $square): bool {
        if ($square->x < 1 || $square->x > 8) {
            return true;
        }
        if ($square->y < 1 || $square->y > 8) {
            return true;
        }
        return false;
    }

    private function foundGoal($b): bool {
        foreach ($this->possiblePaths as $possiblePath) {
            $isGoal = $this->isSameSquare($possiblePath[array_key_last($possiblePath)], $b);
            if ($isGoal) {
                $this->goal = $possiblePath;
                return true;
            }
        }
        return false;
    }

    private function isSameSquare(Policko $a, Policko $b): bool {
        if ($a->x === $b->x && $a->y === $b->y) {
            return true;
        }
        return false;
    }

    private function isAlreadyVisited(Policko $square): bool {
        return in_array($square->getKey(), $this->visited);
    }

}
