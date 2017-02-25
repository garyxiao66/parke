<?php

function array_depth(array $array) {
    $max_depth = 0;
    $level=count($array);
    if($level ==0){
        $max_depth = 'Empty array';
    }
    else{
        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
            }
        }
    }
    }
    return $max_depth;
}
/*
$myArr = array(
    "firstLel"=>array(
        "myKey"=>50,
        "secondLel"=>array(1,2,4)
    )
);
$myAyy_1 = array();
  //$maxLel = count($myArr);  
$maxLel = array_depth($myArr);
echo $maxLel;

*/