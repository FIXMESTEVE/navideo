<?php
error_reporting(1);
ini_set('display_errors', 1);

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

include "srcPHP/main.php";
$m = new Main();
$m->run();
?>
