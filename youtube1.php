<?php
echo "Random link By GENIUS";
echo "MNOGO SI LUD BATE";
echo "SAMO ZA IBOXNEWS";
echo "https://www.youtube.com/watch?v=Ce0DDdl3v6w&list=PLVwO7eWIbqReia76k5mTYLmTORqoIzfW8",


$urls = array(
"https://www.youtube.com/watch?v=ohhb71Q2qZ8",
); 
$url = $urls[array_rand($urls)]; 
header("Location: $url"); 
?>