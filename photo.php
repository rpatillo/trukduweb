<?PHP
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Camagru</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <?php include 'header.php';?>
        <div id="wrapperbody">
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
        data = data.replace('data:image/png;base64,', '');
        
   console.log(data);
      
 //       var postData = JSON.stringify({ imgData: data });
      
    
//              if(window.openDatabase){
//              var shortName = 'tata.db';
//              var version = '1.0';
//              var displayName = 'Display Information';
//              var maxSize = 65536; // in bytes
//              //db = openDatabase(shortName, version, displayName, maxSize);
//                  
//            console.log("TOTO");
//        }
      
//    photo.setAttribute('src', data);
//      if (window.openDatabase) {
//        var db = openDatabase('./camagru.db', '1.0', 'database', 2000000);
//        db.transaction(function (tx) {
//            tx.executeSql('CREATE TABLE foo (id unique, text)');
//            console.log("TEST!");
//        });
//  
//      }
    }
   
    function savepicture() {
        console.log(data);
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


<?PHP
    if ($_GET['pipou']) {
        echo 'OK!';
    }
?>
