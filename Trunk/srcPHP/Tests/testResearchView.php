<?php
session_start();

$_SESSION['research']['videos'] = null;

header('Content-type: text/html; charset=utf-8');

require_once('common.php');

require_once($root.'Model/Model.php');
require_once($root.'Model/ResearchModel.php');

require_once($root.'View/View.php');
require_once($root.'View/Form/FormView.php');
require_once($root.'View/Form/DoctorForm/TagsResearch.php');

try
{
    $view = new TagsResearch($_SERVER['SCRIPT_NAME']);
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
        <title>Test : Research (view)</title>
        <?php
            $view->linkCSS();
            $view->linkJS();
        ?>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    </head>
    <body>
        <h1>Rechercher une vidéo en fonction des méta-données</h1>
        <?php
            if(isset($_GET['execute']))
                $view->execute();
            $view->draw();
            if(isset($_SESSION['research']))
            {
                echo '<p>Vidéo(s) trouvée(s) :</p>';
                echo '<pre>';
                if(!is_null($_SESSION['research']['videos']) && !empty($_SESSION['research']['videos']))
                    var_dump($_SESSION['research']['videos']);
                else
                    echo 'aucune vidéo';
                echo '</pre>';
            }
        ?>
    </body>
</html>
<?php
$_SESSION = array();

session_destroy();
?>