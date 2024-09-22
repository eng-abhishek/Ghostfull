$(document).ready(function () {
	// $('#share_Modal').modal('show');

/*Tooltip*/
	$('[data-bs-toggle="tooltip"]').tooltip({
		trigger : 'hover'
	});
/*Tooltip*/

    $('[data-trigger="image_uploader"]').click(function(e){
		e.preventDefault();
		$('#image_uploader').focus().trigger('click');
	});
	$('#image_uploader').change(function() {
		// console.log($(this).get(0).files);
		var list_length = $('#preview_list li').length;
		var set_id = list_length;
		var arr = [];
		$('#preview_list li').each(function(){
			var str = $(this).find('img').attr('data-image-name');
			arr.push(str);  
		});
		//console.log(arr);
		var filesAmount = $(this).get(0).files;
		for (var i = 0; i < filesAmount.length; i++) {
			const file_image = $(this).get(0).files[i];
			var ext = file_image.name.split('.').pop().toLowerCase();
			if(arr.indexOf(file_image.name) !== -1)
				{
					//console.log("Yes, the value exists!");
				}
				else
				{
					//console.log("No, the value is absent.");
					if(file_image && $.inArray(ext, ['gif','png','jpg','jpeg']) != -1){
						$('#toggler').prop('checked', true);
						//console.log(file_image.name);
						var reader = new FileReader();
						reader.onload = function(event) {
							set_id++;
							var image_alt = file_image.name.split('.').shift();
							$($.parseHTML('<li class="p-2" id="list_'+set_id+'"><div class="result-image"><img id="image_'+set_id+'" src="'+event.target.result+'" data-image-name="'+file_image.name+'" alt="'+image_alt+'" class="img-fluid"><a href="#" data-id="image_'+set_id+'" class="action-btn edit" title="Edit"></a><a href="#" class="action-btn delete" title="Delete"></a></div><input type="hidden" name="preview_image[]" value="'+event.target.result+'"></li>')).appendTo('#preview_list');
							$('#offcanvasForm').show();
							$('#upload_btn').prop('disabled', false);
							}
						}
					else{
						Swal.fire({
							icon: 'error',
							title: 'Oops...',
							text: 'Please select Images Only!',
							showConfirmButton: false, 
							timer: 2500
						  });
					}
						reader.readAsDataURL(file_image);
				}
		}	
		$(this).val('');
	});
	$(document).on('click', '.edit', function (){
		var image_id = $(this).data('id');
		var image_name = $('#'+image_id).attr('alt').split('.').shift();
		$('#image_name').val(image_name);
		const img = new Image();
		img.onload = function() {
		$('#image_width').val(this.width).attr('max',this.width);
		$('#image_height').val(this.height).attr('max',this.height);
		}
		img.src = $('#'+image_id).attr('src');
		$('#modal_image').attr('src', img.src)
			
		$('#edit_image_Modal').modal('show');
	});
	
	$(document).on('click', '.delete', function (){
		$(this).closest('li').empty().removeClass().removeAttr('id');
		if(!$('#preview_list li').hasClass('p-2')){
			$('#offcanvasForm').hide();
			$('#upload_btn').prop('disabled', true);
		}
	});

	$(document).on("keyup change", "#image_width, #image_height", function (e){
		var t = $(this).closest('.resize-wrap'),
			o = $('#image_width', t),
			t = $('#image_height', t),
			i = o.attr('max') / t.attr('max'),
			i = {
				width: Math.round(o.prop('value') / i),
				height: Math.round(t.prop('value') * i)
			};
		$(e.target).is(o) ? t.prop("value", Math.round(i.width)) : o.prop("value", Math.round(i.height))
	});

	$('#viaURLForm').submit(function (e) {
		e.preventDefault();
		var url = $('#image_url').val();
		$.ajax({
			url: url,
			type:'HEAD',
			error: function()
			{
				$('#image_url_msg').html('Please enter a valid url');
			},
			success: function()
			{
				$('#image_url_msg').html('');
				$('#preview_list li').remove();
				var ext = url.split('.').pop().toLowerCase();
				if($.inArray(ext, ['gif','png','jpg','jpeg']) != -1){
				var image_alt = url.split('/')[url.split('/').length-1].split('.')[0]; 
				$($.parseHTML('<li class="p-2" id="list_1"><div class="result-image"><img id="image_1" src="'+url+'" data-image-name="'+image_alt+'.'+ext+'" alt="'+image_alt+'" class="img-fluid"><a href="#" data-id="image_1" class="action-btn edit" title="Edit"></a><a href="#" class="action-btn delete" title="Delete"></a></div><input type="hidden" name="preview_image[]" value="'+url+'"></li>')).appendTo('#preview_list');
				$('#offcanvasForm').show();
				$('#upload_btn').prop('disabled', false);
				$('#url_Modal').modal('hide');
				$('#image_url').val('');
				}
			}
		});
	});

	$('.copy-link').click(function (e) {
		e.preventDefault();
		var copy_btn = $(this);
		var element = $(this).prev('.link-list');
		var $temp = $('<input>');
		$('body').append($temp);
		if (element.val()){
			$temp.val(element.val()).select().focus();
		}
		else{
			$temp.val(element.text()).select();
		}		
		document.execCommand('copy');
		$temp.remove();
		$(this).text('Copied');
		setTimeout(function(){
			copy_btn.text('Copy');
		}, 2500);
	});
	
	/*Drag & Drop*/
	// preventing page from redirecting
	$(document).on("dragstart dragenter dragover", function(e) {
		e.preventDefault();
		e.stopPropagation();
		$('#toggler').prop('checked', true);
	});
	
	$(document).on('drop', function (e) {
		e.stopPropagation();
		e.preventDefault();
		
		var file = e.originalEvent.dataTransfer.files;
			var list_length = $('#preview_list li').length;
			var set_id = list_length;
			var arr = [];
			$('#preview_list li').each(function(){
				var str = $(this).find('img').attr('data-image-name');
				arr.push(str);
			});
			var filesAmount = file.length;
			for (var i = 0; i < filesAmount; i++) {
				const file_image = file[i];
				var ext = file_image.name.split('.').pop().toLowerCase();
				if(arr.indexOf(file_image.name) !== -1)
					{
						//console.log("Yes, the value exists!");
					}
					else
					{
						//console.log("No, the value is absent.");
						if(file_image && $.inArray(ext, ['gif','png','jpg','jpeg']) != -1){
							//console.log(file_image.name);
							var reader = new FileReader();
							reader.onload = function(event) {
								set_id++;
								var image_alt = file_image.name.split('.').shift();
								$($.parseHTML('<li class="p-2" id="list_'+set_id+'"><div class="result-image"><img id="image_'+set_id+'" src="'+event.target.result+'" data-image-name="'+file_image.name+'" alt="'+image_alt+'" class="img-fluid"><a href="#" data-id="image_'+set_id+'" class="action-btn edit" title="Edit"></a><a href="#" class="action-btn delete" title="Delete"></a></div><input type="hidden" name="preview_image[]" value="'+event.target.result+'"></li>')).appendTo('#preview_list');
								$('#offcanvasForm').show();
								$('#upload_btn').prop('disabled', false);
								}
							}
						else{
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Please select Images Only!',
								showConfirmButton: false,
								timer: 2500
							  });
						}
							reader.readAsDataURL(file_image);
					}
			}
	});
	
	$('.btn-reset').click(function (e) {
		e.preventDefault();
		$('#offcanvasForm').hide();
		$('#upload_btn').prop('disabled', true);
		$('#preview_list li').remove();
	});
});