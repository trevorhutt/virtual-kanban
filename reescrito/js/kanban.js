$(document).ready(function() {
	/* Manipulación de columnas */
	
	$('#add_col').click(function(){
		var id=$(".task_pool").size();
		$("#task_pool_header_container").append('<th class="task_pool_header"><div class="header_name click">'+id+'</div><div wip="0" class="WIP">WIP: Ilimitado</div></th>');
		$("#task_pool_container").append('<td class="task_pool"></td>');
		intialize_sortables();
	});
	$('#remove_col').click(function(){
		$(".task_pool_header").last().remove();
		$(".task_pool").last().remove();
		intialize_sortables();
	});	

	$('.header_name').live('click',function(){
		var cur_name=$(this).html();
		var wip = $(this).parent().children("div:eq(1)").attr("wip");
		wip = check_number(wip);
		var header_new_html=' \
		<div class="header_input"> \
			Nombre<br/><input class="input header_input_name" value="'+cur_name+'" /> \
		</div>  \
		<div class="header_input"> \
			WIP<br/><input class="input header_input_name" value="'+wip+'" /> \
		</div>  \
		<div class="small"> \
			<div class="option save_header">Guardar</div> \
		</div> \
		<div class="clear"></div> \
		';
		$(this).parent().html(header_new_html);
	});
	$('.save_header').live('click',function(){
    	var index=$(this).parent().parent().index();    	
		var new_name=$(this).parent().parent().children("div:eq(0)").first().children(".input").first().val();
		var wip=$(this).parent().parent().children("div:eq(1)").first().children(".input").first().val();
		wip = check_number(wip);
		if(index==0){
		    wip=0; // Primera columna debe tener el wip ilimitado
		}
		if(wip>0){
    		$(this).parent().parent().html('<div class="header_name">'+new_name+'</div><div wip="'+wip+'" class="WIP">WIP: '+wip+'</div>');
		}else{
        	$(this).parent().parent().html('<div class="header_name">'+new_name+'</div><div wip="'+wip+'" class="WIP">WIP: Ilimitado</div>');
    	}
	});

	/* Manipulación de tareas */
	$('#add_task').click(function(){
		var id=find_next_box_itm_free(0);
		$(".task_pool").first().append(' \
			<div id="box_itm'+id+'"class="box_itm rounded"> \
				<div id="name'+id+'" class="name">'+id+'</div> \
				<div id="progress_bar'+id+'" class="pbar"></div> \
				<div class="small"> \
					<div n="'+id+'" class="option close">Cerrar</div> \
					<div n="'+id+'" class="option edit">Editar</div> \
				</div> \
				<div class="clear"></div> \
			</div>\
		');
		$( "#progress_bar"+id ).progressbar({
			value: 0
		});
	});
	
	$(".save").live('click', function(){
		var id = $(this).attr("n");
		var box_itm_name=$('#name_input'+id).val();
		var pbar_value=parseInt($('#progress_input'+id).val());
		pbar_value = check_number(pbar_value);
		var box_itm_new_html=' \
				<div id="name'+id+'" class="name">'+box_itm_name+'</div> \
				<div id="progress_bar'+id+'" class="pbar"></div> \
				<div class="small"> \
					<div n="'+id+'" class="option close">Cerrar</div> \
					<div n="'+id+'" class="option edit">Editar</div> \
				</div> \
				<div class="clear"></div> \
		';
		$('#box_itm'+id).html(box_itm_new_html);
		$( "#progress_bar"+id ).progressbar({
			value: pbar_value
		});
	});
	$('.edit').live('click', function() {
		var id = $(this).attr("n");
		var box_itm_name=$('#name'+id).html();
		var pbar_value=$('#progress_bar'+id).progressbar( "value" );
		var box_itm_new_html=' \
				<div><span class="small">Nombre:</span><input id="name_input'+id+'" class="input" value="'+box_itm_name+'" /></div>  \
				<div><span class="small">Progreso:</span><input id="progress_input'+id+'" class="input" value="'+pbar_value+'" /></div>  \
				<div class="small"> \
					<div n="'+id+'" class="option save">Guardar</div> \
				</div> \
				<div class="clear"></div> \
		';
		$('#box_itm'+id).html(box_itm_new_html);
	});
	$('.close').live('click', function() {
		var id = $(this).attr("n");		
		$('#box_itm'+id).remove();
	});

    intialize_sortables();
});

/* Funciones auxiliares */
function intialize_sortables(){
	$( ".task_pool" ).sortable({
			connectWith: ".task_pool",
			delay:25,
			dropOnEmpty: true,
			forcePlaceHolderSize: true,
 			helper: 'clone',
 			forceHelperSize: true,
			receive: function(event, ui) {
					var itms=$(this).children(".box_itm").length;
					var index=$(this).index();
					var wip=$(this).parent().parent().children("tr th:eq("+index+")").children("div:eq(1)").first().attr("wip");
					wip = check_number(wip);
					if((wip!=0)&&(itms>wip))
					{
						$(ui.sender).sortable('cancel');
						alert("WIP exceded");
					}
				}
	});
};
function find_next_box_itm_free(id){
	if($('#box_itm'+id).length)
	{
		id++;
		return find_next_box_itm_free(id);
	}
	else
	{
		return id;
	}
}
function check_number(number){
    if(isNaN(number)||(number<0))
	{
		number=0;
	}
	else if (number>100)
	{
		number=100;
	}
	return number;
}
