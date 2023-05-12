<?php

use Illuminate\Support\Collection;

require '../vendor/autoload.php';

$numbers = new Collection([
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
]);

echo "<pre>";
var_dump($numbers);
echo "</pre>";

if($numbers->contains(10)){
    echo 'Number 10 is included.';
}

$even = $numbers->filter(function($number){
    return $number % 2 == 0;
});

echo "<pre>";
var_dump($even);
echo "</pre>";