/* Theme Name: The Project - Responsive Website Template
 * Author:HtmlCoder
 * Author URI:http://www.htmlcoder.me
 * Author e-mail:htmlcoder.me@gmail.com
 * Version: 2.0.0
 * Created:March 2015
 * License URI:http://support.wrapbootstrap.com/
 * File Description: Place here your custom scripts
 */

(function($){
	$(document).ready(function(){

		// Notify Plugin - The below code (until line 42) is used for demonstration purposes only
		//-----------------------------------------------
		if (($(".main-navigation.onclick").length>0) && !Modernizr.touch ){
			$.notify({
				// options
				message: 'The Dropdowns of the Main Menu, are now open with click on Parent Items. Click "Home" to checkout this behavior.'
			},{
				// settings
				type: 'info',
				delay: 10000,
				offset : {
					y: 150,
					x: 20
				}
			});
		};
		if (!($(".main-navigation.animated").length>0) && !Modernizr.touch && $(".main-navigation").length>0){
			$.notify({
				// options
				message: 'The animations of main menu are disabled.'
			},{
				// settings
				type: 'info',
				delay: 10000,
				offset : {
					y: 150,
					x: 20
				}
			}); // End Notify Plugin - The above code (from line 14) is used for demonstration purposes only

		};
        $(document).on('click', '.share-button', function (e) {
            e.stopPropagation();
            var window_size;
            var url = $(this).attr('href');
            var domain = url.split('/')[2];
            if(domain == 'facebook.com'){
                window_size = ",width=585, height=368";
            } else if(domain == 'twitter.com'){
                window_size = ",width=585, height=261";
            } else if(domain == 'plus.google.com'){
                window_size = ",width=517, height=511";
            } else{
                return false;
            }
            window.open(url, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes'+window_size);
            return false;
        });
        $(document).on('click', '.dontShowAgainBtn', function () {
        	var url 			= $(this).attr('data-url');
        	var id 				= $(this).attr('data-popup-id');
        	var data 			= {id: id};
        	var csrf_token 		= $(this).attr('data-csrf-token');
        	var csrf_value 		= $(this).attr('data-csrf-value');
        	data[csrf_token]	= csrf_value;
        	$.post(url, data, function () {});
        });
	}); // End document ready

})(this.jQuery);
