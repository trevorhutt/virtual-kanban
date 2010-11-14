function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}
	function changeHeader(n){
	
	}
	
	function draw_box(){
	    	id = $('.ui-state-default').size();
		var str_li = '<li id="item'+ id +'" class="ui-state-default box_itm"><p class="box_itm_name">Item '+ id +'</p><div id="progress'+ id +'" p="0" class="pbar"/><p class="box_itm_opt"><a n= '+ id +' href="#">Edit </a><span style="cursor:pointer" n= '+ id +'>Close</span></p></li>';
		$("#sortable1").append(str_li).find("li:last").css({display:"none"}).fadeIn('slow');
		$( "#progress"+id ).progressbar({
			value: 0
		});
	}
	
	function draw_col(i){
    		str_head_col='<th id="th_'+ i +'" class="col_prop_header">' + i +'<small style="cursor:pointer" n="'+ i +'" id="edit_head"> E </small></th>';
		str_col='<td class="col_prop"><ul id="sortable'+ i +'" class="connectedSortable ui-sortable col_itm" ></ul></td>';
		$('#cabec').append(str_head_col);
		$('#cuerp').append(str_col);
	}
	
	function draw_cols(n){
		if (!isNumber(n)) return alert("Only numbers from 3 to 7 are accepted");
		if (n < 3 ) n=3; 
		if (n > 7 ) n=7; 
		$('#cabec').html('');
		$('#cuerp').html('');
		
		for (i=1; i<= n; i++){
			draw_col(i);
		}		
		initialize_sortables();
	}
	
	function initialize_sortables(){
    	$( ".col_itm" ).sortable({
			connectWith: ".connectedSortable",
			dropOnEmpty: true,
			forcePlaceHolderSize: true,
			cursor: 'crosshair',
 			helper: 'clone',
 			forceHelperSize: true
		});	
	}
	
	$(function() {
		
		$('a').live('click', function() {
		  var i = $(this).attr("n");
		  var value = $('#item'+ i).text().replace( /Edit/, '' );
		  var prog = $('#progress'+ i).attr("p");
		  value = value.replace( /Close/, '' );
		  $('#item'+i).html('<small>Name:</small><input style="width:120px;color:#150517;background:whitesmoke;border: 1px solid silver" id ="box'+i+'" type="text" value="'+ value +'"/><br><small>Progress:</small><input style="width:120px;color:#150517;background:whitesmoke;border: 1px solid silver" id ="prog'+i+'" type="text" value="'+ prog +'"/><div n="'+i+'" style="cursor:pointer"><small><small>Save</small></small></di>').width('120px');		  
		});
		
		
		$('div').live('click', function() {
		  var i = $(this).attr("n");
		  var content = $('#box'+i).val(); 
		  var prog = parseInt($('#prog'+i).val()); 
		  $('#item'+i).replaceWith('<li id="item'+ i +'" class="ui-state-default"><p>'+content+'</p><div id="progress'+ i +'" p="'+prog+'" class="pbar"/><p align="right"><small><small><a n= '+ i +' href="#">Edit</a>&nbsp;<span style="cursor:pointer" n= '+ i +'>Close</span></small></small></p></li>').width('120px');
		  $( "#progress"+i ).progressbar({
				value: prog
		  });
		});
		
		$('#edit_head').live('click', function() {
		  var i = $(this).attr("n");
		  $('#th_'+i).replaceWith('<th id="th_'+ i +'" style="background-color: white;border: medium solid rgb(136, 136, 136);"><input style="width:90px;color:#150517;background:whitesmoke;border: 1px solid silver" id ="head_name'+i+'" type="text" />&nbsp;<small id="head_box" n='+i+'><small style="cursor:pointer">Save</small></small></th>');
		});
		
		$('#head_box').live('click', function() {
		  var i = $(this).attr("n");
		  $('#th_'+i).replaceWith('<th id="th_'+ i +'" style="background-color: white;border: medium solid rgb(136, 136, 136);">'+ $('#head_name'+i).val() +' <small><small style="cursor:pointer" n="'+ i +'" id="edit_head">E</small></small></th>');
		});
		
		$('span').live('click', function() {
		  var i = $(this).attr("n");
		  $('#item'+i).fadeOut(500, function(){ 
		    $('#item'+i).remove();
		  });
		});
		
		$('#add').click(function(){
			draw_box();
		});	
		
		
		$('#txt_btn').click(function(){
			$('#texto').toggle('slow');
		});
		
		
		draw_cols(3);	

	});
