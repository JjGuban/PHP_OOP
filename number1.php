<?php
class Rectangle {
    // Properties
    private $width;
    private $height;

    // Constructor with default values
    public function __construct($width = 1, $height = 1) {
        $this->width = $width;
        $this->height = $height;
    }

    // Method to get area
    public function getArea() {
        return $this->width * $this->height;
    }

    // Method to get perimeter
    public function getPerimeter() {
        return 2 * ($this->width + $this->height);
    }

    // Optional: getters and setters
    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function setHeight($height) {
        $this->height = $height;
    }
}

// Example usage
$rectangle1 = new Rectangle(); // Default 1x1
echo "Rectangle 1 - Area: " . $rectangle1->getArea() . "<br>";
echo "Rectangle 1 - Perimeter: " . $rectangle1->getPerimeter() . "<br>";

$rectangle2 = new Rectangle(5, 10);
echo "Rectangle 2 - Area: " . $rectangle2->getArea() . "<br>";
echo "Rectangle 2 - Perimeter: " . $rectangle2->getPerimeter() . "<br>";
?>
