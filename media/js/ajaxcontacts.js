/**
 * File
 * Created    10/2/14 12:40 PM
 * Author     Matt Thomas | matt@betweenbrain.com | http://betweenbrain.com
 * Support    https://github.com/betweenbrain/
 * Copyright  Copyright (C) 2014 betweenbrain llc. All Rights Reserved.
 * License    GNU GPL v2 or later
 */


(function ($) {
	$(document).ready(function () {

		$(document).on('change', '.ajaxcontacts select', function () {
			var request = {
				'option' : 'com_ajax',
				'module' : 'ajaxcontacts',
				'suburb' : $('.ajaxcontacts [name=suburb] option:selected').val(),
				'state'  : $('.ajaxcontacts [name=state] option:selected').val(),
				'country': $('.ajaxcontacts [name=country] option:selected').val(),
				'format' : 'json'
			};
			$.ajax({
				type   : 'POST',
				data   : request,
				success: function (response) {

					var result = '<div class="row-fluid">';

					for (var i = 0; i < response.data.length; i++) {

						result += '<div class="contact span12">' +
						'<h3>' + response.data[i].name + '</h3>' +
						'<img src="' + response.data[i].image + '" />' +
						'<p>Suburb: ' + response.data[i].suburb + ' <br />' +
						'State: ' + response.data[i].state + ' <br />' +
						'Country: ' + response.data[i].country + ' </p>';

						result += '</div>';
					}
					result += '</div>';

					$('.results').html(result);
				}
			});
			return false;
		});

	});
})(jQuery)