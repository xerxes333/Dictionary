

// just a dash of js to spice things up a bit for the user
$('#dictionary-button').on('click', function (e) {
	$(this).prop('disabled', true);
	$('#button-helpBlock').removeClass('hidden');
	$(this).prepend('<span class="glyphicon glyphicon-refresh glyphicon-spin"></span> ');
});

$('.scheduler-button').on('click', function (e) {
	
	$(".scheduler-button").removeClass('btn-success');
	$(this).addClass('btn-success');
	
	$("#results-well").find("#results pre").html('<span class="glyphicon glyphicon-refresh glyphicon-spin" style="font-size:32px;"></span> ');
	
	// all this should do is call the curl action and pass a var to determine the correct action to take
	$.ajax({
		url: 'http://'+ document.domain +'/site/curl',
		method: "GET",
		dataType: "json",
		data: { action: $(this).val()},
		success: function(data) {
			// console.log(data.response);
			$("#results-well").find("#url").html(data.url);
			$("#results-well").find("#results pre").html(data.response);
		}
      });

	return false;
});

$("body").on("click", "a.episode_link", function(){

    var id =  $(this).attr("media_id");
    var title =  $(this).attr("media_title");

    var player= `
        <h3>${title}</h3>
        <!-- ngIf: freebeeLoaded -->
        <limelightplayer style="" class="" media="${id}" ng-if="freebeeLoaded">
            <a style="border:0;clip:rect(0 0 0 0);display:block;height:1px;margin:-1px;outline:none;overflow:hidden;padding:0;position:absolute;width:1px;" title="Flash start" tabindex="-1" href="#limelight_player_45041" id="beforeswfanchor0"></a>
            <object tabindex="0" 
            type="application/x-shockwave-flash" autoplay="true" id="limelight_player_45041" name="limelight_player_45041" 
            class="LimelightEmbeddedPlayerFlash swfPrev-beforeswfanchor0 swfNext-afterswfanchor0" 
            data="//video.limelight.com/player/loader.swf" height="537px" width="100%"> 
                <param name="movie" value="https://video.limelight.com/player/loader.swf"> 
                <param name="wmode" value="window"> 
                <param name="allowScriptAccess" value="always">
                <param name="allowFullScreen" value="true">
                <param name="flashVars" value="playerForm=fc40dbd8074e41dcb70d5f47bbf85da1&amp;autoplay=false&amp;autoplayNextClip=false&amp;mediaId=${id}"> 
            </object>
            <a style="border:0;clip:rect(0 0 0 0);display:block;height:1px;margin:-1px;outline:none;overflow:hidden;padding:0;position:absolute;width:1px;" title="Flash end" tabindex="-1" href="#limelight_player_45041" id="afterswfanchor0"></a>
        </limelightplayer>
        <!-- end ngIf: freebeeLoaded -->
    `;

    $("#Video").html(player);

});