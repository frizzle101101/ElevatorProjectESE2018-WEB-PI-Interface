

function showTime(){
	var currTime = new Date();
	var months = ['January','February','March','April','May','June','July','August','September','October','November', 'December'];
	var dateID = document.getElementById('cDate');
	var timeID = document.getElementById('cTime');

	dateID.innerHTML = months[currTime.getMonth()] + ' ' + currTime.getDate() + ' ' + currTime.getFullYear();
	timeID.innerHTML = currTime.getHours() + ':' + currTime.getMinutes() + ':' + currTime.getSeconds();


}

setInterval(showTime, 1000);//call again in 1 second
