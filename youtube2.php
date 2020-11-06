<?php
echo "Random link By GENIUS";
echo "MNOGO SI LUD BATE";
echo "SAMO ZA IBOXNEWS";
echo "https://www.youtube.com/watch?v=--0BO9Yjk7k&list=PLVwO7eWIbqReia76k5mTYLmTORqoIzfW8&index=7",



$urls = array(
"https://www.youtube.com/watch?v=9zqwubFvPNY",
); 
$url = $urls[array_rand($urls)]; 
header("Location: $url"); 
?>