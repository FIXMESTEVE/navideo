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
    
    if(isset($_GET['form']))
        if(strcasecmp($_GET['form'], 'searchMetaArgs') == 0
            && isset($_POST['title'], $_POST['observation']) && !empty($_POST['title']) && !empty($_POST['observation']))
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
        else if(strcasecmp($_GET['form'], 'listMetadatas') == 0
                && isset($_POST['id'], $_POST['sort']) && is_numeric($_POST['id']))
        {
            $id   = intval($_POST['id']);
            $sort = htmlspecialchars($_POST['sort']);
            
            if(strcasecmp($sort, 'none') == 0)
                $res = $model->getListMetadata($id);
            else if(strcasecmp($sort, 'time') == 0)
                $res = $model->getListMetadataByTime($id);
            else if(strcasecmp($sort, 'title') == 0)
                $res = $model->getListMetadataByTitle($id);
        }
        else if(strcasecmp($_GET['form'], 'allVideos') == 0)
        {
            $res = $model->getAllVideo();
        }
        else if(strcasecmp($_GET['form'], 'login') == 0
                && isset($_POST['type'], $_POST['id'], $_POST['pwd']))
        {
            $type = htmlspecialchars($_POST['type']);
            $id   = htmlspecialchars($_POST['id']);
            $pwd  = htmlspecialchars($_POST['pwd']);
            
            if($id !== '' && $pwd !== '')
            {
                if(strcasecmp($type, 'admin') == 0)
                    $res = $model->getAdministrator($id, $pwd);
                else if(strcasecmp($type, 'doctor') == 0)
                    $res = $model->getDoctor($id, $pwd);
            }
        }
        else if(strcasecmp($_GET['form'], 'listPatients') == 0
                && isset($_POST['id'], $_POST['has']) && is_numeric($_POST['id']))
        {
            $id  = intval($_POST['id']);
            $has = htmlspecialchars($_POST['has']);
            
            if(strcasecmp($has, 'in') == 0)
                $res = $model->getListOfPatients($id);
            else if(strcasecmp($has, 'notin') == 0)
                $res = $model->getListOfNotPatients($id);
        }
        else if(strcasecmp($_GET['form'], 'patientVideos') == 0
                && isset($_POST['id']) && is_numeric($_POST['id']))
        {
            $id  = intval($_POST['id']);
            $res = $model->getVideosPatient($id);
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
                            if(is_null($res) || $res === false || empty($res))
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
            <h1>Recherche de vidéo(s) avec les métadonnées</h1>
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
        <section>
            <h1>Liste des métadonnées d'une vidéo</h1>
            <form method="post" action="?form=listMetadatas">
                <label for="videoSort">Tri : </label>
                <select id="videoSort" name="sort">
                    <option value="none" selected="true">aucun</option>
                    <option value="time">chronologique</option>
                    <option value="title">titre</option>
                </select><br>
                <label for="videoId">ID vidéo : </label>
                <input type="text" id="videoId" name="id"><br>
                <input type="submit" value="Chercher">
            </form>
        </section>
        <section>
            <h1>Afficher toutes les vidéos</h1>
            <form method="post" action="?form=allVideos">
                <input type="submit" value="Afficher">
            </form>
        </section>
        <section>
            <h1>Identification</h1>
            <form method="post" action="?form=login">
                <table>
                    <tr>
                        <td><label for="logType">Type :</label></td>
                        <td>
                            <select id="logType" name="type">
                                <option value="admin" selected="true">admin</option>
                                <option value="doctor">doctor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="logId">Identifiant :</label></td>
                        <td><input type="text" id="logId" name="id"></td>
                    </tr>
                    <tr>
                        <td><label for="logPwd">Mot de passe :</label></td>
                        <td><input type="password" id="logPwd" name="pwd"></td>
                    </tr>
                </table>
                <input type="submit" value="Connexion">
            </form>
        </section>
        <section>
            <h1>Liste des (non) patients</h1>
            <form method="post" action="?form=listPatients">
                <label for="doctorId">ID docteur : </label>
                <input type="text" id="doctorId" name="id"><br>
                <label for="doctorHas">Les patients appartiennent à la liste du docteur ? </label>
                <select id="doctorHas" name="has">
                    <option value="in" selected="true">oui</option>
                    <option value="notin">non</option>
                </select><br>
                <input type="submit" value="Chercher">
            </form>
        </section>
        <section>
            <h1>Afficher les vidéos d'un patient</h1>
            <form method="post" action="?form=patientVideos">
                <label for="patientId">ID patient : </label>
                <input type="text" id="patientId" name="id"><br>
                <input type="submit" value="Afficher">
            </form>
        </section>
    </body>
</html>