<?php
include_once "srcPHP/View/View.php";

class TagView implements View{

	/* Identification */
	var $id;

	/* Data */
	var $title;
	var $observation;
	var $start;
	var $end;

	function TagView($id, $title, $observation, $start, $end){
		assert(is_numeric($id) && is_string($title) && is_string($observation) && is_string($start) && is_string($end),
		       get_class($this).'::'.__FUNCTION__.'($id, $title, $observation, $start, $end) - Les paramètres ne sont pas corrects.');
		
		$this->id    = $id;
		$this->start = $start;
		$this->end   = $end;
		$this->title = $title;
		$this->observation = $observation;
	}

	function timeToNbSeconds($time){
		try{
			if(is_string($time)){
				$tmp = explode(":",$time);
				if(count($tmp) == 3 && is_numeric($tmp[0]) && is_numeric($tmp[1]) && is_numeric($tmp[2]))
					return $tmp[2]+60*$tmp[1]+360*$tmp[0];
				else
					throw new Exception("ERREUR - Fonction timeToNbSeconds(...) - Verifier la structure du parametre \"**:**:**\"");
			}
			else
				throw new Exception("ERREUR - Fonction timeToNbSeconds(...) - Verifier les types des parametres");
		} catch(Exception $e){
			echo $e->getMessage();
		}
	}

	function linkCSS(){ echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/tag.css\" >"; }

	function linkJS(){ echo "<script src=\"js/tag.js\"></script>"; }

	function onLoadJS(){ return ""; }

	function draw() {
		echo '<tr class="tag" onclick="onClickTag('.$this->start.');" onmouseover="onMouseOver(this);" onmouseout="onMouseOut(this);">';
		echo '<td class="id"    style="display:none;">'.$this->id.'</td>';
		echo '<td class="title" style="display:none;">'.$this->title.'</td>';
		echo '<td class="start" style="display:none;">'.$this->start.'</td>';
		echo '<td class="end"   style="display:none;">'.$this->end.'</td>';
		echo '<td class="id">'.$this->observation.'</td>';
		echo '</tr>';
		//echo "<li class=\"tag\" onclick=\"onClickTag(".$this->start.");\" onmouseover=\"onMouseOver(this);\" onmouseout=\"onMouseOut(this);\" >".$this->observation."</li>";
	}

}
?>
