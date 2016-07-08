work_ID = "";

$('document').ready(
	function(){
		$("#mngeApButton").addClass("black");
		$('ul.tabs').tabs('select_tab', 'tab_id');
	}
);

function reloadPage(url){
	window.location.href = url+'manage_selectable_work';
}

function workDescriptionOnChange(){
	$("#workDescriptionLabel").removeAttr("data-error");
	$("#workDescriptionLabel").html("Work Description");
	if($("#workDescription").hasClass("invalid")) $("#workDescription").removeClass("invalid");
}

function addNewSelectableWork(url){

	err = false;

	if($("#workDescription").val()===""){
		$("#workDescriptionLabel").attr("data-error","This is a required field");
		$("#workDescriptionLabel").html(
			"Work Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#workDescription").addClass("invalid");
		err = true;
	}

	if(err) return;

	$.post(
		url+"add_new_work",
		{
			workCost:$("#workCost").val().toLowerCase(),
			workDescription:$("#workDescription").val().toLowerCase()
		},
		function(data){
			console.log(data);
			if(data==="Added new work option"){
				$("#selectableWorkAddedModal").openModal({dismissible:false});
			}
		}
	);
}

function openUpdateSelectableWorkModal(url,workID){
	work_ID = workID;

	$.post(
		url+"get_work_details",
		{workID:workID},
		function(data){
			data = $.parseJSON(data);
			$("#newWorkCost").val(data.workCost);
			$("#newWorkDescription").val(data.workDescription);
			$("#updateSelectableWorkModal").openModal({dismissible:false});
		}
	);
}

function newWorkDescriptionOnChange(){
	$("#newWorkDescriptionLabel").removeAttr("data-error");
	$("#newWorkDescriptionLabel").html("New Work Description");
	if($("#newWorkDescription").hasClass("invalid")) $("#newWorkDescription").removeClass("invalid");
}

function updateSelectableWork(url){

	err = false;

	if($("#newWorkDescription").val()===""){
		$("#newWorkDescriptionLabel").attr("data-error","This is a required field");
		$("#newWorkDescriptionLabel").html(
			"New Work Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+
			"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
		);
		$("#newWorkDescription").addClass("invalid");
		err = true;
	}

	if(err) return;

	$.post(
		url+"update_selectable_work",
		{
      workID:work_ID,
			workCost:$("#newWorkCost").val().toLowerCase(),
			workDescription:$("#newWorkDescription").val().toLowerCase()
		},
		function(data){
			if(data==="Selectable work updated"){
				$("#updateSelectableWorkModal").closeModal();
				$("#selectableWorkUpdatedModal").openModal({dismissible:false});
			}
		}
	);
}

function hideSelectableWork(url,workID){
	$.post(
		url+"hide_selectable_work",
		{workID:workID},
		function(data){
			if(data==="Selectable work hidden"){
				reloadPage(url);
			}
		}
	);
}

function makeSelectableWorkVisible(url,workID){
	$.post(
		url+"make_selectable_work_visible",
		{workID:workID},
		function(data){
			if(data==="Selectable work made visible"){
				reloadPage(url);
			}
		}
	);
}
