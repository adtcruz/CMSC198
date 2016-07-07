$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('ul.tabs').tabs('select_tab', 'tab_id');
	}
);


function materialNameOnChange(){
	$("#materialNameLabel").removeAttr("data-error");
	$("#materialNameLabel").html("Material Name");
	if($("#materialName").hasClass("invalid")) $("#materialName").removeClass("invalid");
}

function materialDescriptionOnChange(){
	$("#materialDescriptionLabel").removeAttr("data-error");
	$("#materialDescriptionLabel").html("Material Description");
	if($("#materialDescription").hasClass("invalid")) $("#materialDescription").removeClass("invalid");
}

function addNewSelectableMaterial(url){

	err = false;

	if($("#materialName").val()===""){
		$("#materialNameLabel").attr("data-error","This is a required field");
		$("#materialNameLabel").html(
			"Material Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#materialName").addClass("invalid");
		err = true;
	}

	if($("#materialDescription").val()===""){
		$("#materialDescriptionLabel").attr("data-error","This is a required field");
		$("#materialDescriptionLabel").html(
			"Material Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#materialDescription").addClass("invalid");
		err = true;
	}

	if($("#materialUnitMeasurement").val()===null){
		err = true;
	}

	if(err) return;

	$.post(
		url+"add_new_material",
		{
			materialName:$("#materialName").val(),
			materialCost:$("#materialCost").val(),
			materialDescription:$("#materialDescription").val(),
			materialUnitMeasurement:$("#materialUnitMeasurement").val()
		},
		function (data){
			console.log(data);
		}
	);
}
