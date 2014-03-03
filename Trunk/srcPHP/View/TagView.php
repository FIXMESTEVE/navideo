<?php
/**
 * TagView.php
 *
 * Long description for file (if any)...
 *
 * @author
 * @copyright  2014
 */

include_once "View.php";

/**
 * TagView
 *
 * Long description for class (if any)...
 *
 */
class TagView implements View {

  /* Identification */
  private $id;
  private $video;

  /* Data */
  private $title;
  private $observation;
  private $start;
  private $end;

  function TagView($id, $video, $title, $observation, $start, $end) {
    if(!is_numeric($id) || !is_numeric($video) || !is_string($title) || !is_string($observation) || !is_string($start) || !is_string($end))
      throw new Exception("TagView(...) - Vérifiez le type des paramètres");

    $this->id    = $id;
    $this->video = $video;
    $this->title = $title;
    $this->observation = $observation;
    $this->start = $start;
    $this->end   = $end;
  }

  function getObservation() {
    return $this->observation;
  }

  function linkCSS(){ }

  function draw() {
    echo "<tr class=\"TagView $this->id $this->video\">";
    echo "<td class=\"title\">$this->title</td>";
    echo "<td class=\"start\">$this->start</td>";
    echo "<td class=\"end\">$this->end</td>";
    echo "</tr>";
  }

}
?>
