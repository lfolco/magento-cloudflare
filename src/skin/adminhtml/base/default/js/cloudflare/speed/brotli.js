const $ = require ("jquery")
const notification = require ("cloudflare/core/notification")

$( document ).on ( "cloudflare.speed.brotli.initialize", function ( event, data ) {
	var value = data.response.payload.value == "on"
	$( data.section ).find ("[name='mode']").prop ( "checked", value )
});

$( document ).on ( "cloudflare.speed.brotli.toggle", function ( event, data ) {
	var state = $( data.section ).find ("[name='mode']:checked").length > 0
	$( data.section ).addClass ("loading")
	$.ajax ({
		url: data.form.endpoint,
		type: "POST",
		data: { "form_key": data.form.key, "state": state },
		success: function ( response ) {
			if ( response && response.state != "response_success" ) {
				$( data.section ).find ("[name='mode']").prop ( "checked", !state );
			}
			notification.addMessages ( response.state, response.messages );
			$( data.section ).removeClass ("loading")
		}
	});
});