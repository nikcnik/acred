function rmvContent(table,id,htmlId) {
	$.ajax({
		type: 'POST' , 
		url: 'func/rmvContent.php' ,
		data: {'rmvT': table , 'rmvId': id } ,
		success: function (data) {
			if (data==2||data==1) {
				$(htmlId).remove();
				location.reload();
			}else{
				$(htmlId).remove();
			}

		}
	});
}