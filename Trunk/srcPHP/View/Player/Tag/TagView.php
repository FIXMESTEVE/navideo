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
		try{
			if(is_numeric($id) && is_string($title) && is_string($observation) && is_string($start) && is_string($end)){
				$this->id = $id;
				$this->title = $title;
				$this->observation = $observation;
				$this->start = $this->timeToNbSeconds($start);
				$this->end  = $end;
			}
			else
				throw new Exception("ERREUR - TagView(...) - Verifier les types des parametres");
		}catch(Exception $e){
			echo $e->getMessage();
		}
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

	function draw(){
		echo "<li class=\"tag\" onclick=\"onClickTag(".$this->start.");\" onmouseover=\"onMouseOver(this);\" onmouseout=\"onMouseOut(this);\" >".$this->observation."</li>";
	}

}
?>
