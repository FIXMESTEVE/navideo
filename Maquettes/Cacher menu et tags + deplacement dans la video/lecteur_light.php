<div id="player" style="float:left;text-align:center;width:100%;">	
	<video	id="vid" controls src="video/video.mp4" type="video/mp4"
			style="float:left;text-align:center;width:80%;">
		Your browser does not support the video tag.
	</video>
	<ul type=none id="liste_etiquette" style="border-width:1px;border-style:solid;padding:0px;margin:0px;float:left;text-align:center;width:19%;overflow:scroll;">
		<script type="text/javascript">
			if (window.XMLHttpRequest){	// code for IE7+, Firefox, Chrome, Opera, Safari
				xmlhttp=new XMLHttpRequest();
			}
			else{	// code for IE6, IE5
				xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.open("GET","xml_file.xml",false);
			xmlhttp.send();

			var xmlDoc=xmlhttp.responseXML;

			var tab = xmlDoc.getElementsByTagName("ACTION");
			for(i=0; i<tab.length; i++){
				document.write("<li style=\"padding-top:10px;padding-bottom:10px;border-bottom-style:solid;border-width:1px;\" onclick=\"document.getElementById('vid').currentTime=");
				document.write(tab[i].getElementsByTagName("DEPART")[0].childNodes[0].nodeValue);
				document.write(";\" onmouseover=\"this.style.background='lightblue';\" onmouseout=\"this.style.background='white';\" >");
				document.write(tab[i].getElementsByTagName("OBSERVATION")[0].childNodes[0].nodeValue);
				document.write("</li>");
			}
		</script>
	</ul>
	<script>
		var tmp = document.getElementById("vid").offsetHeight;
		document.getElementById("liste_etiquette").style.height = tmp+"px";
	</script>
</div>
