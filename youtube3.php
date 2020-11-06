<?php
echo "Random link By GENIUS";
echo "MNOGO SI LUD BATE";
echo "SAMO ZA IBOXNEWS";
echo "https://www.youtube.com/watch?v=wMH63ix_zaU&list=PLVwO7eWIbqReia76k5mTYLmTORqoIzfW8&index=5",


$urls = array(
"https://www.youtube.com/watch?v=Eto6toB4tDg",
); 
$url = $urls[array_rand($urls)]; 
header("Location: $url"); 
?>