<html>
<!--

    Copyright (C) 2010  Leandro Vázquez Cervantes (leandro-[at]-leandro-[dot]-org)
    Copyright (C) 2010  Octavio Benedí Sánchez (octaviobenedi[at]gmail[dot]com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/licenses/.
    
    version 0.2b 12/11/2010

-->



<head>
	<title>Visual Kanban, an online resource to build and share your kanban boards</title>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<META NAME="keywords"    CONTENT="kanban, agile, dashboard, board, SCRUM, visual kanban, virtual kanban, lean, tablero, tablero kanban"> 
	<META NAME="description" CONTENT="Virtual kanban is a free online tool for composing your own board online in order to get informed about and control your production proccess"> 
	<script src="js/jquery.min.js" type="text/javascript"></script> 
	<script src="js/jquery-ui.min.js" type="text/javascript"></script> 
	<link rel="stylesheet" href="js/jquery-ui.css" type="text/css" media="all" /> 	
	<style>
	#sortable1,    #sortable2,    #sortable3,    #sortable4,    #sortable5,   #sortable6,     #sortable7 { list-style-type: none; margin: 1; padding: 1; float: left; margin-right: 8px; }
	#sortable1 li, #sortable2 li, #sortable3 li, #sortable4 li, #sortable5 li, #sortable6 li, #sortable7 li{ margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; }
	.pbar{height:10px;}
	</style>
	<script>
	function isNumber(n) {
	  return !isNaN(parseFloat(n)) && isFinite(n);
	}
	function changeHeader(n){
	
	}
	
	function draw_cols(n){
		if (!isNumber(n)) return alert("Only numbers from 3 to 7 are accepted");
		if (n < 3 ) n=3; 
		if (n > 7 ) n=7; 
		$('#cabec').html('');
		$('#cuerp').html('');
		//$('td').remove();
		for (i=1; i<= n; i++){
			str_head_col='<th id="th_'+ i +'" style="background-color: white;border: medium solid rgb(136, 136, 136);">'+ i +' <small><small style="cursor:pointer" n="'+ i +'" id="edit_head">E</small></small></th>';
			str_col='<td style="border: medium solid rgb(136, 136, 136);"  align="center"><ul id="sortable'+ i +'" class="connectedSortable ui-sortable" style="min-height: 300px; min-width:135px;"><li style="visibility: hidden;"></li></ul></td>';
			$('#cabec').append(str_head_col);
			$('#cuerp').append(str_col);
		}
		
		$( "#sortable1, #sortable2, #sortable3, #sortable4, #sortable5, #sortable6, #sortable7" ).sortable({
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
			id = $('.ui-state-default').size();
			var str_li = '<li id="item'+ id +'" width="120px" class="ui-state-default"><p>Item '+ id +'</p><div id="progress'+ id +'" p="0" class="pbar"/><p align="right"><small><small><a n= '+ id +' href="#">Edit</a>&nbsp;<span style="cursor:pointer" n= '+ id +'>Close</span></small></small></p></li>';
			$("#sortable1").append(str_li).find("li:last").css({display:"none"}).fadeIn('slow');
			$( "#progress"+id ).progressbar({
				value: 0
			});
		});	
		
		
		$('#txt_btn').click(function(){
			$('#texto').toggle('slow');
		});
		
		draw_cols(3);
	});
	</script>
</head>
<body style="background-color:white">

<table width="99%">
<tr>
<td align="left" width="50%"><small>See <a name="top" href="http://blog.virtualkanban.net">the blog</a> for news & updates!</small></td><td align="right"><small>version 0.2b</small></td>
</tr>
</table>

<table align="center" id="cabecera">
<tr><td colspan="2" align="center">
	<h1 style="color:silver; font-size:16px">One-File-HTML Kanban boards online and offline!</h1>
</td></tr>
<tr><td>
<h1>
	<img src="img/logo.png" border="0" alt="Virtual Kanban"/></td><td valign="top">
	<img src="img/beta.png" border="0" alt="beta"/>
</h1>
</td></tr>
</table>
</center>
<p align="center"><input value="new task" id="add" type="button">
number of columns <input type="text" id="n_cols" value="3" size="1" onchange="draw_cols($(this).val());"/>  <small><small>(<code>TAB</code> to apply, from 3 to 7)</small></small>
</p>
<div class="demo">
</div>
<table style="border: medium solid rgb(136, 136, 136);" id="tabla" align="center" border="1">
<thead id="cabec"></thead>
<tbody id="cuerp"></tbody>
</table>
</div>

<div id="texto">
<br/><hr>
<h2>What is kanban?</h2>
<p>
	<b>Kanban</b> (meaning "<i>signboard</i>" or "<i>billboard</i>") is a concept related to lean and just-in-time (JIT) production. According to Taiichi Ohno, the man credited with developing Just-in-time (JIT), kanban is one means through which JIT is achieved.
<b>Kanban</b> is not an inventory control system. Rather, it is a scheduling system that tells you what to produce, when to produce it, and how much to produce.<br/>
The need to maintain a high rate of improvements led <i>Toyota</i> to devise the kanban system. Kanban became an effective tool to support the running of the production system as a whole. In addition, it proved to be an excellent way for promoting improvements because reducing the number of kanban in circulation highlighted problem areas.<br/>
<a href="http://en.wikipedia.org/wiki/Kanban">Learn more about Kanban in Wikipedia</a>
</p>
<br/><hr>
<h2>Need Persistence?</h2>
<p>
	Modify your board as you want, when you were at your desired situation <b>simply save the webpage at your desktop</b>. It will work there! This way is very easy to distribute and share your board with your mates!
</p>
<br/><hr>
<h3>TO DO</h3>
<p><small>
	<p>* Improve graphics and visual style of the site</p>
	<p>* Colored cards</p>
	<p>* Persistence of the boards saving the data in a database</p>
	<p>* Add WIP limits</p>
</small></p>
<br/><hr>
</div>
<p align="center" id="footer">
<input type="button" id="txt_btn" value="show/hide text"/><br/>
<small>&copy; virtualkanban.net - leandro<script>document.write('@');</script>leandro<script>document.write('.');</script>org <i>me fecit</i></small> <br/>
<iframe 
src="http://www.facebook.com/plugins/like.php?href=http://virtualkanban.net&amp;layout=standard&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80"
 scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
</p>

</body>
</html>
