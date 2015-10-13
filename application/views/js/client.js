jQuery(document).ready(function() {

	url = document.location.href.replace('room', 'room_ajax');

	function messageChat() {

		idFirstMessage = jQuery(".message:first").attr("id");

		jQuery.post(url, {

			message: jQuery(".message:first").attr("id"),

		}, onAjaxSuccess);

	}

	function onAjaxSuccess(data) {

		if (data) {

			obj = jQuery.parseJSON(data);
			
		
if ( obj.messages) {

			jQuery.each(obj.messages, function() {
 
				idMessage = '#' + idFirstMessage;

				jQuery(idMessage).before('<p id="' + this.id + '" class="message">' + this.date.substr(11, 8) + ' ' + this.login + ': ' + this.text + '</p>');



			});


		}
		
		if ( obj.users) {	
		
	activeRecipient =	jQuery("#recipient").val();
	
	activeRecipient = '#recipient [value="'+activeRecipient+'"]';
	
		jQuery( '#recipient' ).text( '' );
	jQuery( '#recipient' ).append( '<option value="0">For all</option>' );
	
	
	jQuery.each(obj.users, function() {
	
	jQuery( '#recipient' ).append( '<option value="' + this.id + '"> ' + this.login + '</option>' );
	
	});
	console.log(activeRecipient);

	jQuery(activeRecipient).attr("selected", "selected");
		
	}
		
		
		}
}

	if (jQuery.cookie("PHPSESSID") != '') {

		setInterval(messageChat, 2000);

	}

})
