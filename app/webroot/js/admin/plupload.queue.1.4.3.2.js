// Convert divs to queue widgets when the DOM is ready
$(function() {
	$("#uploader").pluploadQueue({
		// General settings
		runtimes : 'html5,html4',
		url : 'uploadmultiplefiles',
		max_file_size : '60mb',
		chunk_size : '10mb',
		unique_names : true,

		// Resize images on clientside if we can
		//resize : {width : 320, height : 240, quality : 90},

		// Specify what files to browse for
		filters : [
			{title : "Docs files", extensions : "pdf, txt, doc, odt, ott, xml, docx, sxw, stw, rtf, fodt, uot, xls, csv, ods, sxc"},
			{title : "Zip files", extensions : "zip, rar, 7zip, tar, tar.gz, gz"},
                        {title : "Images f.orig", extensions : "psd, xcf"}
		],

		// Flash settings
		flash_swf_url : '/plupload/js/plupload.flash.swf',
		// Silverlight settings
		silverlight_xap_url : '/plupload/js/plupload.silverlight.xap'
	});

	// Client side form validation
	$('#FicheroAddForm2').submit(function(e) {
		var uploader = $('#uploader').pluploadQueue();

		// Validate number of uploaded files
		if (uploader.total.uploaded == 0) {
			// Files in queue upload them first
			if (uploader.files.length > 0) {
				// When all files are uploaded submit form
				uploader.bind('UploadProgress', function() {
					if (uploader.total.uploaded == uploader.files.length)
						$('#FicheroAddForm2').submit();
				});

				uploader.start();
			} else
				alert('You must at least upload one file.');

			e.preventDefault();
		}
	});
        
});