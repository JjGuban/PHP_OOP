<?php
class QuadraticEquation {
    private $a;
    private $b;
    private $c;

    // Constructor
    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    // Getters
    public function getA() { return $this->a; }
    public function getB() { return $this->b; }
    public function getC() { return $this->c; }

    // Discriminant: b^2 - 4ac
    public function getDiscriminant() {
        return ($this->b ** 2) - (4 * $this->a * $this->c);
    }

    // Root 1
    public function getRoot1() {
        $disc = $this->getDiscriminant();
        if ($disc < 0) {
            return null; // no real root
        }
        return (-$this->b + sqrt($disc)) / (2 * $this->a);
    }

    // Root 2
    public function getRoot2() {
        $disc = $this->getDiscriminant();
        if ($disc < 0) {
            return null; // no real root
        }
        return (-$this->b - sqrt($disc)) / (2 * $this->a);
    }
}

// ----------- TEST OUTPUT -----------
$solve = new QuadraticEquation(1, -3, 2); // x² - 3x + 2 = 0

echo "Discriminant: " . $solve->getDiscriminant() . "<br>";
echo "Root 1: " . $solve->getRoot1() . "<br>";
echo "Root 2: " . $solve->getRoot2() . "<br>";
?>
