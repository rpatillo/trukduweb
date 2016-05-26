<!DOCTYPE html>
<?PHP
session_start();
?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php';?>
        <div id="wrapper">
            <img src="/img/CamagruBig.jpg" width="100%">
            <nav id="image_area">
                <video id="video"></video>
                <canvas id="canvas"></canvas></br>
            </nav>
            <button id="startbutton">Take a picture</button>
            <button id="savebutton">Save</button>
        </div>
        <?php include 'footer.php';?>
    </body>
</html>

<script>
(function() {

  var streaming = false,
      video        = document.querySelector('#video'),
      cover        = document.querySelector('#cover'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#startbutton'),
      width = 320,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL();
    photo.setAttribute('src', data);
    }
   
    function savepicture() {
        console.log("SVG");       
    }

  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);
    
  savebutton.addEventListener('click', function(ev){
      savepicture();
    ev.preventDefault();
  }, false);

})();
</script>