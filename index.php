<?php

namespace Src;

require_once ("Application.php");

$example = new Application();

$getDates = $example->changeDateFormat(array("2010/03/30", "15/12/2016", "11-12-2010", "20131010"));

echo "<h1>test  </h1>";


echo $example->displayResults($getDates);

$exampleTwo =  [1, 'a', 'b', 2, 3];

$filteredArray = $example->filterArray($exampleTwo);

echo $example->displayResults($filteredArray);

$exampleArr =  [1, 2, 4];

$exampleThree = $example->prependSum($exampleArr);

echo $example->displayResults($exampleThree);

$username = "21g-fn msvha-ds";
$username = "Mike-Standish";

$examplesix = $example->validate($username);

echo $example->displayResults($examplesix);



$arr = [
    "apple",
    ["banana", "strawberry", "apple"]
];

$exampleSeven =  [1, 'abba', 'abba', 'aabbA', 'b', 2, 3];

$count = $example->numberOfItems($arr, 'apple');

echo $example->displayResults($count);