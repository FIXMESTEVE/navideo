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
