

// just a dash of js to spice things up a bit for the user
$('#dictionary-button').on('click', function (e) {
	$(this).prop('disabled', true);
	$('#button-helpBlock').removeClass('hidden');
	$(this).prepend('<span class="glyphicon glyphicon-refresh glyphicon-spin"></span> ');
});

$('#scheduler-button').on('click', function (e) {
	
	// all this should do is call the curl action and pass a var to determine the correct action to take
	$.ajax({
		url: 'http://dictionary.dev/site/curl',
		method: "GET",
		data: { action: $(this).val()},
		success: function(data) {
			// $("#results-well").find("#url").html( method + " " + url);
			$("#results-well").find("#results").html(data);
		}
      });


});