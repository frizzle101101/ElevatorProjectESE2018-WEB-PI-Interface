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

document.getElementById("currentFloor").addEventListener("onchange", function(){
  if(document.getElementById("currentFloor").innerHTML == "1")
  {
    floor1.update();
  }
  if(document.getElementById("currentFloor").innerHTML == "2")
  {
    floor2.update();
  }
  if(document.getElementById("currentFloor").innerHTML == "3")
  {
    floor3.update();
  }
});
