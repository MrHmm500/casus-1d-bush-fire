<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

$lines = [];
$fire = [];
fscanf(STDIN, "%d", $N);
for ($i = 0; $i < $N; $i++)
{
    $fire[$i] = [];
    $lines[] = stream_get_line(STDIN, 255 + 1, "\n");
    foreach (str_split($lines[$i]) as $index => $letter) {
        if ($letter != '.') {
            $fire[$i][$index] = true;
        }
    }
}

$extinguished = [];
foreach($fire as $i => $fireline) {
    $amountOfWater = 0;
    $extinguished[$i] = [];
    foreach($fireline as $index => $firesingular) {
        if(isset($extinguished[$i][$index]) && $extinguished[$i][$index] == true) {
            continue;
        }
        
        $extinguished[$i][$index] = true;
        $extinguished[$i][$index+1] = true;
        $extinguished[$i][$index+2] = true;
        $amountOfWater++;
    }
    echo("$amountOfWater\n");
}

