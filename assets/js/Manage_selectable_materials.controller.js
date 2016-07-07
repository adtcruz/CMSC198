$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('ul.tabs').tabs('select_tab', 'tab_id');
	}
);

function addNewSelectableMaterial(url){

	err = false;


	if($("#materialName").val()===""){

		err = true;
	}

	if($("#materialUnitMeasurement").val()===null){

		err = true;
	}

	if(err) return;

	
}
