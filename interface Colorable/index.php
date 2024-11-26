<?php
interface Colorable {
    public function howToColor();
}

interface Resizeable {
    public function resize($percent);
}

class Circle implements Resizeable {
    private $radius;

    public function __construct($radius) {
        $this->radius = $radius;
    }

    public function getArea() {
        return pi() * pow($this->radius, 2);
    }

    public function resize($percent) {
        $this->radius *= (1 + $percent / 100);
    }
}

class Rectangle implements Resizeable {
    private $width;
    private $height;

    public function __construct($width, $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function getArea() {
        return $this->width * $this->height;
    }

    public function resize($percent) {
        $this->width *= (1 + $percent / 100);
        $this->height *= (1 + $percent / 100);
    }
}

class Square extends Rectangle implements Colorable {
    public function __construct($side) {
        parent::__construct($side, $side);
    }

    public function howToColor() {
        return "Color all four sides.";
    }
}

$shapes = [
    new Circle(2),
    new Rectangle(3,4),
    new Square(5)
];

foreach ($shapes as $shape) {
    echo "Diện tích: " . $shape->getArea() . "\n";
    if ($shape instanceof Colorable) {
        echo $shape->howToColor() . "\n";
    }
}