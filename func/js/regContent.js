function regArea(tab) {

	var tabData = $(tab).find('input').serialize();

	$.ajax({
		type: 'POST',
		url:  'func/regContent.php',
		data: tabData ,
		success: function (data) {
			location.reload();
		}
	});
}

function regSubA(tab) {
	var tabData = $(tab).find('select , input').serialize();

	$.ajax({
		type: 'POST',
		url:  'func/regContent.php',
		data: tabData ,
		success: function (data) {
			location.reload();
		}
	});	
}

function regContent(tab) {
	var tabData = $(tab).find('select , textarea').serialize();

	$.ajax({
		type: 'POST',
		url:  'func/regContent.php',
		data: tabData ,
		success: function (data) {
			location.reload();	
		}
	});
}

function getUsers(name,id,type,area) {
	
	var uid = id;
	var utype = type;
	var uname = name;
	var uarea = area;

	$.ajax({
		type: 'POST',
		url:  'func/regContent.php',
		data: { 'uName': uname , 'uId' : uid ,'uType' : utype , 'uArea' : uarea } ,
		success: function (data) {
			$("#userEdit .modal-body ").html(data);

		}
	});	
}

function viewAccManager(tab) {
	$.ajax({
		type: 'POST' ,
		url: 'func/editContent.php' ,
		data: { 'cmdEdit' : 'viewAccManager' } , 
		success: function (data) {
			$(tab).html(data);	
		} 
	});
}