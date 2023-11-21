<?php 
/* 
 $a = 5; 
 $b = "5"; 
 $c = ["a", "b"]; 
 $d = Null; 
 echo gettype($a); 
 echo "<br>"; 
 echo gettype($b); 
 echo "<br>"; 
 echo gettype($c); 
 echo "<br>"; 
 echo gettype($d); 
 
 if ($a == $b){ 
  echo "Yes"; 
 } else { 
  echo "No"; 
 } 
*/ 
 //Ax^2+Bx+C=0 
 $A = 2; 
 $B = 4;
 $C = 2; 
 $D = $B*$B - 4*$A*$C; 
 $x1 = (-$B + sqrt($D))/(2*$A); 
 $x2 = (-$B - sqrt($D))/(2*$A); 


$result_A = "";
if ($A == 1){
    $result_A = "x^2";
} elseif ($A == -1) {
    $result_A = "-x^2";
} elseif ($A > 0 || $A <0) {
    $result_A = "{$A}x^2";
}

$result_B = "";
if ($B == 1){
    $result_B = "+x";
} elseif ($B == -1){
    $result_B = "-x";
} elseif ($B < 0){
    $result_B = "{$B}";
} elseif ($B >0){
    $result_B = "+{$B}";
}

$result_C = "";
if ($C < 0){
    $result_C = "{$C}";
} elseif ($C >0){
    $result_C = "+{$C}";
}


 $result = $result_A.$result_B.$result_C."=0";

 echo $result."<br>";
 echo "D = {$D}<br>";

if ($D < 0){
    echo "D < 0";
} elseif ($D == 0){
    echo "x1 = {$x1}";
} else {
    echo "x1 = {$x1}<br>x2 = {$x2}"; 
}
 
?>