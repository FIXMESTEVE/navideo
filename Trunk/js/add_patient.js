function goToCreateNewPatient(){
	window.location.href = "index.php?form=create_patient";
}

function removePatient(){
	var tmp = document.getElementById("mine").selectedIndex;
	var tmp2 = document.getElementById("mine").options;
	document.getElementById("others").add(tmp2[tmp]);
}

function addPatient(){
	var tmp = document.getElementById("others").selectedIndex;
	var tmp2 = document.getElementById("others").options;
	var tmp3 =  document.getElementById("mine");
	var tmp4 = tmp2[tmp].value;
	tmp3.add(tmp2[tmp]);
	tmp3.options[tmp3.length - 1].value = tmp4.split(" ")[1];
}

function updatePatients(){
	var tmp = document.getElementById("mine").options;
	for(var i=0; i<tmp.length; i++)
		tmp[i].selected = "selected";
}

$(document).ready(function() {
    //jquery code here
    $('#allPatients').change(function(){
		$idPatient = $('#allPatients option:selected').val();

		if($idPatient === null || $idPatient === "" ){
        	$('#videoList :input').attr("disabled");
		}
		else{
			$('#videoList :input').removeAttr("disabled");
        	$.ajax({
	            type: 'POST',
	            url: 'srcPHP/Model/patientSelectedVideo.php',
	            data: {
	                id: $idPatient
	            },
	            success: function(data) {
	            	$('input:checkbox').prop('checked', false);
	            	for(var $i = 0; $i < data.length; $i++){
	            		$('input[name='+ data[$i][0] +']').prop('checked', true);
	            	}
	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown) { 
	                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
	            },
	            cache: false
	        });
		}
	});

	$('input:checkbox').mousedown(function() {
		$idPatient = $('#allPatients option:selected').val();
		$idVideo = $(this)[0].value;
		console.dir($(this));

		if($idPatient === null || $idPatient === "" ){
        	$('#videoList :input').attr("disabled");
		}
		if($(this)[0].checked){
			$.ajax({
	            type: 'POST',
	            url: 'srcPHP/Model/patientClearVideo.php',
	            data: {
	                idVideo: $idVideo
	            },
	            success: function(data) {

	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown) { 
	                alert("Status: " + textStatus); alert("Error: " + errorThrown);
	                $(this).prop('checked', false);
	                console.dir($idVideo);
	            },
	            cache: false
	        });
		}
		else{
        	$.ajax({
	            type: 'POST',
	            url: 'srcPHP/Model/patientAssignVideo.php',
	            data: {
	                idPatient: $idPatient,
	                idVideo: $idVideo
	            },
	            success: function(data) {

	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown) { 
	                alert("Status: " + textStatus); alert("Error: " + errorThrown);
	                $(this).prop('checked', false);
	                console.dir($idVideo);
	            },
	            cache: false
	        });
		}
	});
        
});