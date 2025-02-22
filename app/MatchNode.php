<?php

/**
 * Node for binary tree
 */
class MatchNode {
    /**
     * Child nodes
     */
    public $left;
    public $right;

    /**
     * Match node number
     */
    public $count;

    /**
     * Coords for drawing
     */
    public $x;
    public $y;

    public function __construct($count = 0) 
    {
        $this->left = null;
        $this->right = null;
        $this->count = $count;
    }

    /**
     * Set point coords for center of rectangle
     */
    public function setPoint($x, $y)
    {
        $this->x = (int)$x;
        $this->y = (int)$y;
    }

    /**
     * Draw rectangle for node and its child nodes
     */
    public function draw($image, $color, $width, $height, $totalHeight) 
    {
        $scale = (int)(0.1 * $width);
        $lineX = $this->x - (int)($width / 2) + $scale;

        imagerectangle(
            $image, 
            $lineX,
            $this->y - (int)($height / 2),
            $this->x + (int)($width / 2) - $scale,
            $this->y + (int)($height / 2),
            $color
        );

        imagestring(
            $image, 
            1,
            (int)$this->x,
            (int)$this->y,
            "Match " . $this->count, 
            $color
        );

        $yDiff = ($totalHeight - $this->y) / 2;
        $newX = $this->x - $width;

        if (!is_null($this->left)) {
            $newY = (int)($this->y - $yDiff);

            $this->left->setPoint(
                $newX,
                $newY
            );
            $this->left->draw($image, $color, $width, $height, $this->y);

            imageline(
                $image, 
                $lineX, 
                $this->y, 
                (int)($newX + ($width / 2)) - $scale, 
                $newY, 
                $color
            );
        }
        
        if (!is_null($this->right)) {
            $newY = (int)($this->y + $yDiff);

            $this->right->setPoint(
                $newX,
                $newY
            );
            $this->right->draw($image, $color, $width, $height, $totalHeight);

            imageline(
                $image, 
                $lineX, 
                $this->y, 
                (int)($newX + ($width / 2) - $scale), 
                $newY, 
                $color
            );
        }
    }
}