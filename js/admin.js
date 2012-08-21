(function ($){
	// Obtain the image dir from WordPress
	var image_dir = (config) ? config.image_path : null;
	
	// Function change image depending of option selected
	function changeImage( field, image_tag, prefix){
		
		if(image_dir){
			var v = field.options[field.selectedIndex].value;
			console.log(image_dir+'/'+((prefix) ? prefix : '')+v+'.png');
			if(prefix && v == 'default')
				$(image_tag).attr('src', image_dir+'/empty.png');
			else{	
			console.log('here');
				$(image_tag).attr('src', image_dir+'/'+((prefix) ? prefix : '')+v+'.png');
			}	
		}	
	} // changeImage
	
	window['changeImage'] = changeImage;
	
	jQuery(function(){
		// Set the tabs
		console.log($('#codepeople-mobile-tabs').length);
		$('#codepeople-mobile-tabs').tabs();
	});
	
})(jQuery);