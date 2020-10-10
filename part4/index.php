<?php

$arr=Array ( 
"musicals" => 
Array ( 'Oklahoma' , 'The Music Man' ,'South Pacific' ),
"dramas" => Array ( 'Lawrence of Arabia','To Kill a Mockingbird','Casablanca' ) ,
"mysteries" => Array ( 'The Maltese Falcon','Rear Window','North by Northwest') );

foreach ($arr as $key => $value) 
{   echo strtoupper($key) . "<br>";
    foreach ($value as $key1 => $value1)
        echo "----> $key1 = $value1 <br>";
    
}
krsort($arr);
echo '<br> Sorted:<br><br>';
foreach ($arr as $key => $value) 
{   echo strtoupper($key) . "<br>";
    //krsort($value);
    foreach ($value as $key1 => $value1)
        echo "----> $key1 = $value1 <br>";
    
}
?>