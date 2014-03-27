<?php
header('Content-type: text/html; charset=utf-8');

$root = str_replace(basename(__FILE__), '', __FILE__);
$root = str_replace(basename($root), '', $root);

require_once($root.'Model/Model.php');
require_once($root.'Model/ResearchModel.php');

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

try
{
    $model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
    echo '<pre>';var_dump($model);echo '</pre>';
    $res = $model->findAllVideosMatchingMetadatasArguments(array(
                                                                array( "title" => "a title", "observation" => "an observation" ),
                                                                array( "title" => "Réveil", "observation" => "Observation 1" ),
                                                                array( "observation" => "Observation 3" ),
                                                                array( "title" => "Télécommande à l'envers")
                                                            ));
    echo '<pre>';var_dump($res);echo '</pre>';
    $model = null;
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}
?>