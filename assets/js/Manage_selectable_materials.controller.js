material_ID = "";

$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
        $('#mngMatButton').removeClass("grey");
        $('#mngMatButton').removeClass("darken-4");
        $('#mngMatButton').addClass('black');
        $('#menuBody').addClass('active');
        $('.collapsible').collapsible(
            {
                accordion: false
            }
        );
		$('ul.tabs').tabs('select_tab', 'tab_id');
	}
);

function reloadPage(url){
	window.location.href = url+'manage_selectable_materials';
}

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
		function(data){
			console.log(data);
			if(data==="Added new material option"){
				$("#selectableMaterialAddedModal").openModal({dismissible:false});
			}
		}
	);
}

function openUpdateSelectableMaterialModal(url,materialID){
	material_ID = materialID;

	$.post(
		url+"get_material_details",
		{materialID:materialID},
		function(data){
			data = $.parseJSON(data);
			$("#newMaterialName").val(data.materialName);
			$("#newMaterialCost").val(data.materialCost);
			$("#newMaterialDescription").val(data.materialDescription);
			if(data.materialUnitMeasurement==="metre"){
				$("#newMaterialUnitMeasurement").html('<option id="nullOption" value="" disabled="disabled">Select Unit Measurement…</option><option id="metreOption" value="metre" selected="selected">metre</option><option id="pieceOption" value="piece">piece</option><option id="unitOption" value="unit">unit</option>');
			}
			if(data.materialUnitMeasurement==="piece"){
				$("#newMaterialUnitMeasurement").html('<option id="nullOption" value="" disabled="disabled">Select Unit Measurement…</option><option id="metreOption" value="metre">metre</option><option id="pieceOption" value="piece" selected="selected">piece</option><option id="unitOption" value="unit">unit</option>');
			}
			if(data.materialUnitMeasurement==="unit"){
				$("#newMaterialUnitMeasurement").html('<option id="nullOption" value="" disabled="disabled">Select Unit Measurement…</option><option id="metreOption" value="metre">metre</option><option id="pieceOption" value="piece">piece</option><option id="unitOption" value="unit" selected="selected">unit</option>');
			}
			$("#updateSelectableMaterialModal").openModal({dismissible:false});
			$("#newMaterialUnitMeasurement").material_select();
		}
	);
}

function newMaterialNameOnChange(){
	$("#newMaterialNameLabel").removeAttr("data-error");
	$("#newMaterialNameLabel").html("New Material Name");
	if($("#newMaterialName").hasClass("invalid")) $("#newMaterialName").removeClass("invalid");
}

function newMaterialDescriptionOnChange(){
	$("#newMaterialDescriptionLabel").removeAttr("data-error");
	$("#newMaterialDescriptionLabel").html("New Material Description");
	if($("#newMaterialDescription").hasClass("invalid")) $("#newMaterialDescription").removeClass("invalid");
}

function updateSelectableMaterial(url){

	err = false;

	if($("#newMaterialName").val()===""){
		$("#newMaterialNameLabel").attr("data-error","This is a required field");
		$("#newMaterialNameLabel").html(
			"newMaterial Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#newMaterialName").addClass("invalid");
		err = true;
	}

	if($("#newMaterialDescription").val()===""){
		$("#newMaterialDescriptionLabel").attr("data-error","This is a required field");
		$("#newMaterialDescriptionLabel").html(
			"newMaterial Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#newMaterialDescription").addClass("invalid");
		err = true;
	}

	if($("#newMaterialUnitMeasurement").val()===null){
		err = true;
	}

	if(err) return;

	$.post(
		url+"update_selectable_material",
		{
      materialID:material_ID,
			materialName:$("#newMaterialName").val(),
			materialCost:$("#newMaterialCost").val(),
			materialDescription:$("#newMaterialDescription").val(),
			materialUnitMeasurement:$("#newMaterialUnitMeasurement").val()
		},
		function(data){
			console.log(data);
			if(data==="Selectable material updated"){
				$("#updateSelectableMaterialModal").closeModal();
				$("#selectableMaterialUpdatedModal").openModal({dismissible:false});
			}
		}
	);
}

function hideSelectableMaterial(url,materialID){
	$.post(
		url+"hide_selectable_material",
		{materialID:materialID},
		function(data){
			if(data==="Selectable material hidden"){
				reloadPage(url);
			}
		}
	);
}

function makeSelectableMaterialModalVisible(url,materialID){
	$.post(
		url+"make_selectable_material_visible",
		{materialID:materialID},
		function(data){
			if(data==="Selectable material made visible"){
				reloadPage(url);
			}
		}
	);
}
