


$('.scheduler-button').on('click', function (e) {
	
	$(".scheduler-button").removeClass('btn-success');
	$(this).addClass('btn-success');
	
	$("#results-well").find("#results pre").html('<span class="glyphicon glyphicon-refresh glyphicon-spin" style="font-size:32px;"></span> ');
	
	// all this should do is call the curl action and pass a var to determine the correct action to take
	$.ajax({
		url: 'http://'+ document.domain +'/scheduler/default/curl',
		method: "GET",
		dataType: "json",
		data: { action: $(this).val()}
      })
      .done(function(data) {
      	// console.log(data.response);
		$("#results-well").find("#url").html(data.url);
		$("#results-well").find("#results pre").html(data.response);
	  })
	  .fail(function(data) {
      	console.log(data);
	  })
	  ;

	return false;
});