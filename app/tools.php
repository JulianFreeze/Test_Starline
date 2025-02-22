<?php

/**
 * Create tree node with child nodes
 */
function createNode($number, &$nodeNum)
{
    if ($number == 1) {
        $nodeNum = $nodeNum - 1;
        $node = new MatchNode($nodeNum);
        return $node;
    }

    $nodeNum = $nodeNum - 1;
    $node = new MatchNode($nodeNum);

    $number -= 1;
    $node->left = createNode($number, $nodeNum);
    $node->right = createNode($number, $nodeNum);

    return $node;
}

/**
 * Build full tree
 */
function createTree($rounds) {
    $currentNode = pow(2, $rounds); 
    return createNode($rounds, $currentNode);
}

/**
 * Draw tree
 */
function drawTree($tree, $rounds, $maxRows, $width, $height, $imagePath) {
    $boxWidth = floor($width/$rounds);
    $boxHeight = floor($height/$maxRows);
    
    $image = imagecreatetruecolor($width, $height);
    
    $backgroundColor = imagecolorallocate($image, 255, 255, 255);
    imagefill($image, 0, 0, $backgroundColor);
    
    $linesColor = imagecolorallocate($image, 0, 0, 0);
    
    $tree->setPoint($width - ($boxWidth/2), $height/2);
    $tree->draw($image, $linesColor, $boxWidth, $boxHeight, $height);
    
    imagepng($image, $imagePath);
    imagedestroy($image);
}