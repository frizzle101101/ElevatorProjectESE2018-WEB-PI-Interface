var dobAF = new Date(1996, 4, 10);
var dobAB = new Date(1989, 6, 18);

var dToday = new Date();

function calculateAge(birthdate, currentdate){
	var ageDiffms = currentdate.getTime() - birthdate.getTime();
	var ageDate = new Date(ageDiffms);
	return Math.abs(ageDate.getFullYear() - 1970);
}

var currentYear = dToday.getFullYear();
var ageAB = calculateAge(dobAB, dToday);
var ageAF = calculateAge(dobAF, dToday);


var copyrightDate = document.getElementById('copydate');
copyrightDate.innerHTML = ' ' + currentYear + ' ';



var AF_Age = document.getElementById('fritzAge');
AF_Age.innerHTML = ' ' + ageAF + ' ';
var AB_Age = document.getElementById('bonnellAge');
AB_Age.innerHTML = ' ' + ageAB + ' ';
