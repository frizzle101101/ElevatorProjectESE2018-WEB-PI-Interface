function reqFloor(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("txtHint").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "reqFloor.php?q="+str, true);
  xhttp.send();
}

function getLatestReqs(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("latestRequests").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("latestRequests").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getLatestReqs.php?q="+str, true);
  xhttp.send();
  setTimeout(function(){getLatestReqs(str);},5000);
}

function getCurrentFloor() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("currentFloor").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getCurrentFloor.php", true);
  xhttp.send();

  setTimeout(function(){getCurrentFloor();},1000);
}


var fBtn1 = document.getElementById("req1");
var fBtn2 = document.getElementById("req2");
var fBtn3 = document.getElementById("req3");

window.addEventListener("load", function(){getLatestReqs(10);});
window.addEventListener("load", function(){getCurrentFloor();});
fBtn1.addEventListener("click", function(){reqFloor(1);});
fBtn2.addEventListener("click", function(){reqFloor(2);});
fBtn3.addEventListener("click", function(){reqFloor(3);});
