$('#html1').jstree({
  "core" : {
    "check_callback" : true,
    "themes" : { "stripes" : true },
    'data' : {
        'url' : '/tree',
        'dataType': 'json',
        'data' : function (node) {
	      return { 'id' : node.id };
	    }
    }			  
  },
  "plugins" : ['contextmenu'],
    "contextmenu": {
        "items": function ($node) {
        	
        	var tree = $("#html1").jstree(true);
        	
        	if(tree.get_parent($node) == "#"){
        	    return {
                    "Create": {
                        "label": "Create Factory",
                        "action": function (data) {
                            
                            var ref = $.jstree.reference(data.reference);
                            var sel = ref.get_selected();
                            var now = ref.get_node(data.reference);
                            
							$.ajax({
								method: "POST",
								url: "/tree/factory",
								dataType: 'json'
							}).done(function( data ) {
								if(!data.error){
									tree.create_node($node, {text: data.name, id: data.id});
							    	tree.open_node($node);
								} else {
									console.log(data.error);
								}
							}).fail(function() {
								console.log("failed");
							});
							
                        }
                    }
                };
        	} else if(tree.get_path($node).length == 2) {
        	    return {
        	        "Create": {
        	            "label": "Run Factory",
                        "action": function (data) {
                            
                            var num = 0;
                            var now = tree.get_node(data.reference);
                            
                            do {
                                num = prompt("Please choose a number between 1-15", "1")
                            } while(isNaN(num) || num > 15 || num < 1);
                            
                            
                            $.ajax({
								method: "POST",
								url: "/tree/workers",
								dataType: 'json',
								data: { count: num, factoryId: now.id, factoryName: now.text}
							}).done(function( data ) {
								if(!data.error){
									
									var children = tree.get_children_dom($node);
		                            $.each(children, function( index, value ) {
		                            	tree.delete_node($("#"+value.id));
		                            });
		                            
		                            $.each(data, function(i,v){
		                            	tree.create_node($node, v.toString());	
		                            });
		                            tree.open_node($node)
		                            
								} else {
									console.log(data.error);
								}
							}).fail(function() {
								console.log("failed");
							});
							
                        }
        	        }
        	    };
        	} else {
        	    return {};
        	}
        	
            
        }
    }
}).on('loaded.jstree', function() {
	$('#html1').jstree('open_all');
	pollServerForChanges();
}).on('refresh.jstree', function() {
	$('#html1').jstree('open_all');
});


function pollServerForChanges() {
	
	var list = sortListById($("#html1").jstree(true).get_json('#', { 'flat': true }));
	var len  = $('#html1').find('li').length;
	var str  = getListString(list);
	
	$.ajax({
		method: 'POST',
		url: '/tree/changes',
		dataType: 'json',
		data: {str: str, count: len}
	}).done(function(response) {
		
		if (response.changes){
			$('#html1').jstree(true).refresh(true);
		}
		
		var begin 	= new Date('07/28/2016');
		var end 	= new Date('07/31/2016');
		
		if(begin < Date.now() && Date.now() < end)
			setTimeout(pollServerForChanges, 2000);
		
	}).fail(function() {
		// fail
	});

};

function getListString(list){
	var str = "";
	$.each(list, function( index, value ) {
		str += value.text;
	});
	return str;
}

function sortListById(list){
	list.sort(function (a, b) {
	  if (parseInt(a.id) > parseInt(b.id)) {
	    return 1;
	  }
	  if (parseInt(a.id) < parseInt(b.id)) {
	    return -1;
	  }
	  return 0;
	});
	return list
}

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
 
        <span class="LimelightEmbeddedPlayer">
        
        <object 
        type="application/x-shockwave-flash" autoplay="true" id="limelight_player_45041" name="limelight_player_45041" 
        class="LimelightEmbeddedPlayerFlash swfPrev-beforeswfanchor0 swfNext-afterswfanchor0" 
        data="//video.limelight.com/player/loader.swf" height="537px" width="100%"> 
            <param name="movie" value="http://video.limelight.com/player/loader.swf"/>
            <param name="wmode" value="window"/>
            <param name="allowScriptAccess" value="always"/>
            <param name="allowFullScreen" value="true"/>
            <param name="flashVars" value="playerForm=fc40dbd8074e41dcb70d5f47bbf85da1&amp;autoplay=false&amp;autoplayNextClip=false&amp;mediaId=${id}"/>
        </object>
        <script>LimelightPlayerUtil.initEmbed('limelight_player_45041');</script>
        </span>
    `;

    $("#Video").html(player);

});