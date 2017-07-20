<?php
$p=7;
$q=3;
$a=rand(2,10);
$b=rand(2,10);
$g1=fmod(pow($q,$a),$p);
$g2=fmod(pow($q,$b),$p);
$x=fmod(pow($g1,$b),$p);
$y=fmod(pow($g2,$a),$p);
echo $x."<br>";
echo $y;

?>