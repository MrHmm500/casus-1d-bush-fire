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

function extractFirePositionFromLines(array $lines): array {
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

function extractOutputFromFire(array $fire): void {
    foreach ($fire as $i => $fireLine) {
        $amountOfWater = 0;
        $extinguished[$i] = [];

        foreach (array_keys($fireLine) as $index) {
            if (isset($extinguished[$i][$index]) && $extinguished[$i][$index]) {
                continue;
            }

            // if fire is detected (happy path), throw water on the one after, so it and any possible others are extinguished
            $extinguished[$i][$index] = true;
            $extinguished[$i][$index+1] = true;
            $extinguished[$i][$index+2] = true;
            $amountOfWater++;
        }

        echo ("$amountOfWater <br />");
    }
}