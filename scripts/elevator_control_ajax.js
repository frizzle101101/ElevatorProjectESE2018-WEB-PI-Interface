function gameLoop () {

  window.requestAnimationFrame(gameLoop);

  //floor1.update();
  //floor2.update();
  //floor3.update();
  floor1.render();
  floor2.render();
  floor3.render();
}
function sprite (options) {

  var that = {},
      frameIndex = 0,
      tickCount = 0,
      ticksPerFrame = options.ticksPerFrame || 0,
      numberOfFrames = options.numberOfFrames || 1;

  that.context = options.context;
  that.width = options.width;
  that.height = options.height;
  that.image = options.image;

  that.openD = function () {

      tickCount += 1;

      if (tickCount > ticksPerFrame) {

        tickCount = 0;
        if (frameIndex < numberOfFrames - 1) {
            // Go to the next frame
            frameIndex += 1;
        }
      }
  };

  that.clsoeD = function () {

      tickCount -= 1;

      if (tickCount > ticksPerFrame) {

        tickCount = 4;
        if (frameIndex > -1) {
            // Go to the next frame
            frameIndex -= 1;
        }
      }
  };

  that.render = function () {
      // Clear the canvas
      //context.clearRect(0, 0, that.width, that.height);
      // Draw the animation
      that.context.drawImage(
         that.image,
         31,
         (frameIndex * that.height) + ((frameIndex + 1) * 75),
         that.width,
         that.height,
         0,
         0,
         that.width,
         that.height);
  };

  that.openDoors = function () {
    var i;
    for (i = 0; i < 4; i++) {
      that.openD();
      that.render();
    }
  };

  that.closeDoors = function () {
    var i;
    for (i = 0; i < 4; i++) {
      that.clsoeD();
      that.render();
    }
  };

  return that;
}

var elvImage = new Image();
elvImage.src = "../images/elv_sprite.png";
var canvas1 = document.getElementById("elvAnimation1");
var canvas2 = document.getElementById("elvAnimation2");
var canvas3 = document.getElementById("elvAnimation3");
canvas1.width  = 83;
canvas2.width  = 83;
canvas3.width  = 83;
canvas1.height = 79;
canvas2.height = 79;
canvas3.height = 79;
var floor1 = sprite({
    context: canvas1.getContext("2d"),
    width: canvas1.width,
    height: canvas1.height,
    image: elvImage,
    numberOfFrames: 4,
    ticksPerFrame: 30
});
var floor2 = sprite({
    context: canvas2.getContext("2d"),
    width: canvas2.width,
    height: canvas2.height,
    image: elvImage,
    numberOfFrames: 4,
    ticksPerFrame: 30
});
var floor3 = sprite({
    context: canvas3.getContext("2d"),
    width: canvas3.width,
    height: canvas3.height,
    image: elvImage,
    numberOfFrames: 4,
    ticksPerFrame: 30
});
floor1.render();
floor2.render();
floor3.render();

elvImage.addEventListener("load", gameLoop);

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
  setTimeout(function(){getLatestReqs(str);},1000);
}

function getQue(str) {
  var xhttp;
  if (str == "") {
    document.getElementById("que").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("que").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "getQue.php?q="+str, true);
  xhttp.send();
  setTimeout(function(){getQue(str);},1000);
}

function getCurrentFloor() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("currentFloor").innerHTML = this.responseText;

      if(this.responseText=="1")
      {
        floor1.openDoors();
        floor2.closeDoors();
        floor3.closeDoors();
      }
      else if(this.responseText=="2")
      {
        floor1.closeDoors();
        floor2.openDoors();
        floor3.closeDoors();
      }
      else if(this.responseText=="3")
      {
        floor1.closeDoors();
        floor2.closeDoors();
        floor3.openDoors();
      }
    }
  };
  xhttp.open("GET", "getCurrentFloor.php", true);
  xhttp.send();



  setTimeout(function(){getCurrentFloor();},10);
}



var fBtn1 = document.getElementById("req1");
var fBtn2 = document.getElementById("req2");
var fBtn3 = document.getElementById("req3");

window.addEventListener("load", function(){getLatestReqs(10);});
window.addEventListener("load", function(){getQue(10);});
window.addEventListener("load", function(){getCurrentFloor();});
fBtn1.addEventListener("click", function(){reqFloor(1);});
fBtn2.addEventListener("click", function(){reqFloor(2);});
fBtn3.addEventListener("click", function(){reqFloor(3);});
