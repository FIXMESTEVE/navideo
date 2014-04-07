<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', E_ALL);

assert_options(ASSERT_ACTIVE, true);
assert_options(ASSERT_WARNING, true);
assert_options(ASSERT_QUIET_EVAL, false);
//*/

$root = str_replace(basename(__FILE__), '', __FILE__);
$root = str_replace(basename($root), '', $root);

function pretty_var_dump($var) {
    echo '<pre>';var_dump($var);echo '</pre>';
}
?>