jQuery(document).ready(function(){
	let timeout = null;
	
	jQuery('#country').on('keyup', function () {
		let countryCode = jQuery(this).val();
		
		clearTimeout(timeout);
		timeout = setTimeout(function () {
			getCountryInfo(countryCode);
		}, 500);
	});
});

function getCountryInfo(countryCode){
	hideError();
	hideResult();
	
	jQuery.ajax({
		url: "http://127.0.0.1:8081/index.php",
		data: {countryCode: countryCode},
		dataType: "json"
	}).success(function(data) {
		let country = data[0] || {};
		
		console.log(country.hasOwnProperty('name'));
		
		if(country.hasOwnProperty('name') && country.hasOwnProperty('prefix')){
			jQuery('#country-name').html(country.name);
			jQuery('#country-prefix').html(country.prefix);
			showResult();
		} else {
			showError('Country not found...');
		}
		
	}).fail(function(){
		showError('There was an error');
	});
}

function hideResult(){
	jQuery('#result').hide();
}

function showResult(){
	jQuery('#result').show();
}

function showError(errorMessage){
	jQuery('#error').html(errorMessage).show();
}

function hideError(){
	jQuery('#error').hide();
}