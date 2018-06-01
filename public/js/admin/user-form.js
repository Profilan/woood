function generateApiKey() {
	sarr = new Array("abcdefghijkmnopqrstuvwxyz", "ABCDEFGHJKLMNPQRSTUVWXYZ",
			"23456789", "~!@#$%^&*()_+-=\[]{};:,./<>?");
	s = new String();
	pw = new String();
	s = sarr[0] + sarr[1] + sarr[2];
	for (var i = 0; i < 40; i++) {
		pw += s.charAt(Math.floor(Math.random() * s.length));
	}
	$('#api_key').val(pw);
}

$( document ).ready( function() {
	$('#generate-api-btn').click(function(e) {
		generateApiKey();
		
		e.preventDefault();
	});
});
