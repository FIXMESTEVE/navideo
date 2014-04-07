<?php
header('Content-type: text/html; charset=utf-8');

require_once('common.php');

require_once($root.'Model/Model.php');
require_once($root.'Model/ResearchModel.php');

try
{
    $model = new ResearchModel("dbserver", "xjouveno", "xjouveno", "pdp");
    //pretty_var_dump($model);
    
    $res = null;
    
    if(isset($_GET['form']) && strcasecmp($_GET['form'], 'searchMetaArgs') == 0
       && isset($_POST['title'], $_POST['observation']))
    {
        $metaArgs = array();
        
        $nbrOfTitles = count($_POST['title']);
        $nbrOfObservations = count($_POST['observation']);
        
        assert($nbrOfTitles === $nbrOfObservations);
        
        for($i=0; $i<$nbrOfTitles; ++$i)
        {
            $title = htmlspecialchars($_POST['title'][$i]);
            $observation = htmlspecialchars($_POST['observation'][$i]);
            
            $arg = array();
            
            if($title !== '')
                $arg['title'] = $title;
            if($observation !== '')
                $arg['observation'] = $observation;
            
            if(!empty($arg))
                $metaArgs[] = $arg;
        }
        
        $res = $model->findAllVideosMatchingMetadatasArguments($metaArgs);
    }

    $model = null;
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}
?>
<!Doctype html>
<html lang="fr">
    <head>
        <title>Research Model</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript">
            function addRow(tableId) {
                jQuery('table#'+tableId+" tr:last").after('<tr><td><input type="text" name="title[]" value=""></td><td><input type="text" name="observation[]" value=""></td></tr>');
            }
        </script>
    </head>
    <body>
        <header>
            <?php
                if(isset($_GET['form'])):
            ?>
                    <pre>
                        <?php
                            if(is_null($res))
                                echo 'Aucun résultat.';
                            else
                                print_r($res);
                        ?>
                    </pre>
            <?php
                endif;
            ?>
        </header>
        <section>
            <h1>Recherche de vidéo(s)</h1>
            <form method="post" action="?form=searchMetaArgs">
                <table id="metaArgs">
                    <tr>
                        <td><input type="text" name="title[]" value="Title..."></td>
                        <td><input type="text" name="observation[]" value="Observation..."></td>
                    </tr>
                </table>
                <input type="button" onclick="addRow('metaArgs');" value="Ajouter des arguments"><br>
                <input type="submit" value="Chercher">
            </form>
        </section>
    </body>
</html>