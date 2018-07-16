var dobAF = new Date(1996, 4, 10);
var dobAB = new Date(1989, 6, 18);

var dToday = new Date();

function calculateAge(birthdate){
	var ageDiffms = dToday.getTime() - birthdate.getTime();
	var ageDate = new Date(ageDiffms);
	return Math.abs(ageDate.getFullYear() - 1970);
}

var currentYear = dToday.getFullYear();
var ageAB = calculateAge(dobAB);
var ageAF = calculateAge(dobAF);


var copyDate = document.getElementById('copydate');
copyDate.innerHTML = '' + currentYear + '';

var fritzAge = document.getElementById('fritzAge');
fritzAge.innerHTML = '' + ageAF + '';
var bonnellAge = document.getElementById('bonnellAge');
bonnellAge.innerHTML = '' + ageAb + '';
