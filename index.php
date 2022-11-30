<?php
$jsonTestCases = file_get_contents('testcases.json');
$testCases = json_decode($jsonTestCases);
foreach ($testCases as $caseName => $caseData) {
    echo "-----------------------------------<br />";
    echo $caseName . ' wordt getest<br />';
    echo 'expected output: <br />';
    echo str_replace ("\n", '<br />', $caseData->expectedOutput) . '<br /><br />';

    $fire = extractFirePositionFromLines(explode("\n", $caseData->input));

    $extinguished = [];
    echo "-----------------------------------<br />";
    echo "actual output:<br />";

    extractOutputFromFire($fire);

    echo "<br />";
}

function extractFirePositionFromLines($lines) {
    $fire = [];
    foreach ($lines as $rowNumber => $letters) {
        $fire[$rowNumber] = [];
        foreach (str_split($letters) as $letterIndex => $letter) {
            if ($letter == 'f') {
                $fire[$rowNumber][$letterIndex] = true;
            }
        }
    }
    return $fire;
}

function extractOutputFromFire($fire) {
    foreach ($fire as $i => $fireline) {
        $amountOfWater = 0;
        $extinguished[$i] = [];

        foreach ($fireline as $index => $firesingular) {
            if (isset($extinguished[$i][$index]) && $extinguished[$i][$index]) {
                continue;
            }

            $extinguished[$i][$index] = true;
            $extinguished[$i][$index+1] = true;
            $extinguished[$i][$index+2] = true;
            $amountOfWater++;
        }

        echo ("$amountOfWater <br />");
    }
}