

// just a dash of js to spice things up a bit for the user
$('#dictionary-button').on('click', function (e) {
	$(this).prop('disabled', true);
	$('#button-helpBlock').removeClass('hidden');
	$(this).prepend('<span class="glyphicon glyphicon-refresh glyphicon-spin"></span> ');
});

$('#scheduler-button').on('click', function (e) {
	
	// GET http://api.domain.com/shifts?user_id=3
	switch($(this).val()){
		case 'emp_shifts':
			url = 'http://dictionary.dev/shifts?user_id=3';
			method = "GET";
			break;
		default:
			return false;
	}
	
	$.ajax({
		url: 'http://dictionary.dev/site/curl',
		method: "GET",
		data: { action: "emp_shifts"},
		success: function(data) {
			// $("#results-well").find("#url").html( method + " " + url);
			$("#results-well").find("#results").html(data);
		}
      });


});