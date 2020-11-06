<?php
echo "Random link By GENIUS";
echo "MNOGO SI LUD BATE";
echo "SAMO ZA IBOXNEWS";



$urls = array(
"https://www.youtube.com/watch?v=2aZXdYJy8v4",
); 
$url = $urls[array_rand($urls)]; 
header("Location: $url"); 
?>