jQuery(document).ready(function($) {
	$('#illustration').hover( function(){
		$(this).addClass('expand');
	}, function(){
		$(this).removeClass('expand');
	} );
    $(".item").click(    function(){$( "#info" ).dialog();}    );
});
