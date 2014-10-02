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
				'option'  : 'com_ajax',
				'module'  : 'ajaxcontacts',
				'category': $('.ajaxcontacts [name=category] option:selected').val(),
				'product' : $('.ajaxcontacts [name=product] option:selected').val(),
				'country' : $('.ajaxcontacts [name=country] option:selected').val(),
				'region'  : $('.ajaxcontacts [name=region] option:selected').val(),
				'format'  : 'json'
			};
			$.ajax({
				type   : 'POST',
				data   : request,
				success: function (response) {
					var result = '<div class="row-fluid">';
					for (var i = 0; i < response.data.length; i++) {

						var params = jQuery.parseJSON(response.data[i].params),
							region = String(params.region),
							solutions = String(params.solutions);

						result += '<div class="contact span4">' +
						'<h3>' + params.company + '</h3>' +
						'<h4>Solutions: ' + solutions.replace(/,/ig, ", ") + ' </h4>' +
						'<h4>Contact: ' + response.data[i].name + ' </h4>' +
						'<h4>Region: ' + region.replace(/,/ig, ", ") + ' </h4>';

						if (response.data[i].telephone.length) {
							result += '<p>Telephone: ' + response.data[i].telephone + ' </p>';
						}

						if (response.data[i].mobile.length) {
							result += '<p>Mobile: ' + response.data[i].mobile + ' </p>';
						}

						if (response.data[i].email_to.length) {
							result += '<p>Email: <a href="mailto:' + response.data[i].email_to + '">' + response.data[i].email_to + '</a></p>';
						}

						if (response.data[i].address.length) {
							result += '<p>' + response.data[i].address + ' <br />' +
							response.data[i].suburb + ' <br />' +
							response.data[i].state + ' <br />' +
							response.data[i].country + ' </p>';
						}
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