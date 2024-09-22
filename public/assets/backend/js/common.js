$(document).ready(function(){
	
	$(".m-select2").select2();

	$(".m-select2-multiple").select2({
		placeholder : "Select"
	});

	$(".m-select2-tag").select2({
		placeholder:"Add a tag",
		tags:!0
	});

});

/* Copy to clipboard */
function copy_to_clipboard(target_id) {
	var target_element = $('#'+target_id);
	var $temp = $("<input>");
	$("body").append($temp);
	$temp.val($(target_element).val()).select();
	document.execCommand("copy");
	$temp.remove();
	toastr.info('Copied');
}

/* Convert string to slug */
function slugify(string) {
	return string.trim()
	.toLowerCase()
	.replace(/[^a-z0-9]+/g,'-')
	.replace(/^-+/, '')
	.replace(/-+$/, '');
}

/* progress bar */
function progressbar(element){
	var classes = ['m--bg-warning', 'm--bg-success', 'm--bg-danger'];
	var max_value = element.attr('maxlength');
	var current_value = element.val().length;
	var progressbar_ref = element.data('progressbar');
	var percentage = current_value * 100/max_value;

	$(progressbar_ref).removeClass(classes[0]).removeClass(classes[1]).removeClass(classes[2]);

	if(percentage <= 50){
		$(progressbar_ref).addClass(classes[0]);
	}else if(percentage > 50 && percentage <= 65){
		$(progressbar_ref).addClass(classes[1]);
	}else{
		$(progressbar_ref).addClass(classes[2]);
	}

	$(progressbar_ref).css('width', percentage+'%').attr('aria-valuenow', percentage);
}

