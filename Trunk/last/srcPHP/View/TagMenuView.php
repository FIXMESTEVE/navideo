<?php
/**
 * TagMenuView.php
 *
 * Long description for file (if any)...
 *
 * @author     
 * @copyright  2014
 */

include_once "View.php";

/**
 * TagMenuView
 *
 * Long description for class (if any)...
 *
 */
class TagMenuView implements View {

  /* Identification */
  private $video;

  /* Data */
  private $tags;

  function TagMenuView($video) {
    if(!is_numeric($video))
      throw new Exception("TagMenuView(...) - Vérifiez le type des paramètres");
    
    $this->video = $video;
    $this->tags  = array();
  }

  function appendTag($tag) {
    if(!($tag instanceof TagView))
      throw new Exception("TagMenuView::appendTag(...) - Vérifiez le type des paramètres");

    $this->tags[] = $tag;
  }

  function draw() {
    echo "<div class=\"TagMenuView\">";
    echo "<table>";
    foreach($this->tags as $tag)
      $tag->draw();
    echo "</table>";
    echo "</div>";
  }

}
?>