<?php

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

class Square extends Rectangle {
    public function __construct($side) {
        parent::__construct($side, $side);
    }
}

$shapes = [
    new Circle(5),
    new Rectangle(4, 6),
    new Square(3)
];

foreach ($shapes as $shape) {
    $percent = rand(1, 100);
    $originalArea = $shape->getArea();
    $shape->resize($percent);
    $newArea = $shape->getArea();

    if ($shape instanceof Circle) {
        echo "Circle: Diện tích trước: $originalArea, sau khi resize: $newArea (Tăng: $percent%)\n";
    } elseif ($shape instanceof Rectangle) {
        echo "Rectangle: Diện tích trước: $originalArea, sau khi resize: $newArea (Tăng: $percent%)\n";
    } elseif ($shape instanceof Square) {
        echo "Square: Diện tích trước: $originalArea, sau khi resize: $newArea (Tăng: $percent%)\n";
    }
}