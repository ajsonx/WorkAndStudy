<?php
/**
 * Created by PhpStorm.
 * User: ajsonx
 * Date: 2019/1/31
 * Time: 12:16
 */

function sum(){
    $a = 1;
    $x = &$a;
    $b = ($a++); //此处括号等于没加
    echo $a.' '.$x.' '.$b."\n";
}
sum();