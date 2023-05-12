<?php

$_SERVER['GATEWAY_INTERFACE'] = 'CLI';

test('Division by zero gives an error', function () {
    //arrange
    require (__DIR__.'/../../index.php');
    //act
    $result = divideOneByX(5);
    //assert
    expect($result)->toEqual('1/5 is 0.2');
});