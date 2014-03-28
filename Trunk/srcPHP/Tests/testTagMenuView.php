<?php
session_start();

header('Content-type: text/html; charset=utf-8');

$root = str_replace(basename(__FILE__), '', __FILE__);
$root = str_replace(basename($root), '', $root);

require_once($root.'Model/Model.php');
require_once($root.'Model/ResearchModel.php');

require_once($root.'View/View.php');
require_once($root.'View/Player/Tag/TagView.php');
require_once($root.'View/Player/Tag/TagMenuView.php');

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);

$defaultVideoId = 10;

if(isset($_GET['tag']) && is_numeric($_GET['tag']))
    $defaultVideoId = (int) $_GET['tag'];

try
{
    $view = new TagMenuView($defaultVideoId);
}
catch(Exception $ex)
{
    echo $ex->getMessage();
    exit(1);
}
?>
<!Doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Test : Tag Menu (view)</title>
        <?php
            $view->linkCSS();
            $view->linkJS();
        ?>
    </head>
    <body<?php if($view->onLoadJS() !== "") echo 'onload="'.$view->onLoadJS().';"'; ?>>
        <h1>Trier les tags</h1>
        <form method="get" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
            <label for="tag">Charger des étiquettes :</label>
            <input type="text" name="tag" value="<?php echo $defaultVideoId; ?>">
            <input type="submit" value="Charger">
        </form>
        <?php
            if($view->countNumberOfTags() > 0)
                $view->draw();
            else
                echo '<p>Il n\'y a aucune étiquette pour la vidéo.</p>';
        ?>
    </body>
</html>
<?php
$_SESSION = array();

session_destroy();
?>