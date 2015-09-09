<?php

echo <<<EOT
 <h2>Array functions test</h2>
EOT;

function sortingTest(array $arr, $sortFunc = 'sort', $flag = 'SORT_REGULAR') {
  $sortFunc($arr, $flag);
  echo "Sorted by <b>$sortFunc</b> function with flag <i>$flag</i>: <br><pre>";
  var_dump($arr);
  echo "</pre>";
}

$arr = array(
  'first' => 'word',
  'third' => 'text',
  'second' => 'number',
);



sortingTest($arr);
sortingTest($arr, 'ksort');
sortingTest($arr, 'arsort');
sortingTest($arr, 'sort', 'SORT_NUMERIC');