function gameLoop () {

  window.requestAnimationFrame(gameLoop);

  elv.update();
  elv.render();
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

  that.update = function () {

      tickCount += 1;

      if (tickCount > ticksPerFrame) {

        tickCount = 0;
        if (frameIndex < numberOfFrames - 1) {
            // Go to the next frame
            frameIndex += 1;
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

  return that;
}

var elvImage = new Image();
elvImage.src = "images/elv_sprite.png";
var canvas = document.getElementById("elvAnimation");
canvas.width = 83;
canvas.height = 79;
var elv = sprite({
    context: canvas.getContext("2d"),
    width: canvas.width,
    height: canvas.height,
    image: elvImage,
    numberOfFrames: 4,
    ticksPerFrame: 30
});
elv.render();

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

var fBtn1 = document.getElementById("req1");
var fBtn2 = document.getElementById("req2");
var fBtn3 = document.getElementById("req3");

fBtn1.addEventListener("click", function(){reqFloor(1);});
fBtn2.addEventListener("click", function(){reqFloor(2);});
fBtn3.addEventListener("click", function(){reqFloor(3);});
