<?php

abstract class Shape {
    abstract public function calculateArea(): float;
}

class Circle extends Shape {
    private float $radius;

    public function __construct(float $radius) {
        $this->radius = $radius;
    }

    public function calculateArea(): float {
        return pi() * $this->radius ** 2;
    }
}

class Rectangle extends Shape {
    private float $width;
    private float $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function calculateArea(): float {
        return $this->width * $this->height;
    }
}

$circle = new Circle(5);
echo "Area of the circle: " . $circle->calculateArea() . " sqr\n";

$rectangle = new Rectangle(4, 6);
echo "Area of the rectangle: " . $rectangle->calculateArea() . " sqr\n";

?>
