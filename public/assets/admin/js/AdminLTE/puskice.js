$(document).ready(function(){
	if($('.btn-remove').length > 0){
		$('.poll-options').on('click', '.btn-remove', function(){
			console.log($(this).closest('.poll-option'));
			$(this).closest('.poll-option').remove();
		});
	}
});

function addOption(text){
	$('.poll-options').append("<div class='row poll-option'>"+
        	"<div class='col-xs-2'>"+
        		"<div class='input-group'>"+
                    "<input type='text' class='form-control' name='voteCount[]' value='0'>"+
                "</div>"+
            "</div>"+
            "<div class='col-xs-10'>"+
            	"<div class='input-group'>"+
                    "<input type='text' class='form-control' name='options[]'>"+
                    "<span class='input-group-btn'>"+
                        "<button class='btn btn-danger btn-flat btn-remove' type='button'>"+text+"</button>"+
                    "</span>"+
                "</div>"+
            "</div>"+
        "</div>"+
        "<br/>");
}