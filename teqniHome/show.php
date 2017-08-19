<?php require_once("includes/db_connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
    $data = $_GET['data'];
    $dataex = explode("_", $data);
    $level1 = $dataex[0];
    $level2 = $dataex[1];
    $level3 = $dataex[2];
    $sessionName = $dataex[3];

    $query = "SELECT * FROM volleyupload WHERE level1 = '{$level1}' AND level2 = '{$level2}' AND level3 = '{$level3}' AND sessionName = '{$sessionName}'";
    $result = mysqli_query($conn, $query);
    $resultVid = mysqli_query($conn, $query);
    $timeResult = mysqli_query($conn, $query);
    confirm_query($timeResult);
    confirm_query($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projection">
    <meta name="author" content="Prashant Bhardwaj">

    <title>Slide Show</title>

    <!-- Bootstrap Core CSS -->
    
   
    <!-- Advanced CSS -->
    
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
</head>


<body onload="initialize();">

	<!-- Navigation -->

   
    <!-- Intro Section -->
    
    <div id="slideshow" class="img-responsive"></div>
    <textarea style="display:none;" id="imgSrc" >
        <?php
            while ($list = mysqli_fetch_assoc($result)) { 
                if ($list['timeDuration']!='0') { 
                    echo $list['imgPath'].",";
                } 
            }
        ?>
    </textarea>
    <textarea style="display:none;" id="vidSrc" >
        <?php
            while ($listVid = mysqli_fetch_assoc($resultVid)) { 
                if ($listVid['timeDuration']=='0') { 
                    echo $listVid['imgPath'].",";
                } 
            }
        ?>
    </textarea>
    <input type="hidden" id="timeDuration" value="<?php
        while ($timeList = mysqli_fetch_assoc($timeResult)) {
            echo $timeList['timeDuration'].'000,';
        }
     ?>">

    

   

    <div id="listencontainer"></div>
    
    <script>

        var imgSrc = document.getElementById("imgSrc").value;
        // console.log(imgSrc);
        var imgEx = imgSrc.split(',');
        var vidSrc = document.getElementById("vidSrc").value;
        var vidEx = vidSrc.split(',');
        var galleryarray = new Array();
        
        
        for (var i = 0; i < vidEx.length - 1; i++) {
            galleryarray.push(vid(vidEx[i].trim()));
        }

        for (var i = 0; i < imgEx.length - 1; i++) {
            galleryarray.push(img(imgEx[i].trim()));
        }

        function img(src) {
        var el = document.createElement('img');
        el.src = src;
        return el;
    }

    var sliding;
    var index = 0;
    var timeDuration = document.getElementById("timeDuration").value;
    var arr = timeDuration.split(',');
    var aru = [];
    for (var i = 0; i < arr.length-1; i++) {
        if(Number(arr[i])) aru.push(parseInt(arr[i], 10));
    }
    console.log(aru);
    window.onload = function () {
        sliding = setInterval(rotateimages, 5000);
        rotateimages();
        //FullScreen won't work in jsFiddle's iframe
        document.getElementById('slideshow').onclick = function () {
            if (this.requestFullscreen) {
                this.requestFullscreen();
            } else if (this.msRequestFullscreen) {
                this.msRequestFullscreen();
            } else if (this.mozRequestFullScreen) {
                this.mozRequestFullScreen();
            } else if (this.webkitRequestFullscreen) {
                this.webkitRequestFullscreen();
            }
        }
    }

    function vid() {
        //Accepts any number of ‘src‘ to a same video ('.mp4', '.ogg' or '.webm')
        var el = document.createElement('video');
        var source = document.createElement('source');
        for (var i = 0; i < arguments.length; i++) {
            source.src = arguments[i];
            source.type = "video/" + arguments[i].split('.')[arguments[i].split('.').length - 1];
            el.appendChild(source);
        }
        el.onplay = function () {
            clearInterval(sliding);
        };
        el.onended = function () {
            sliding = setInterval(rotateimages, curimg);
            rotateimages();
        };
        return el;
    }

    // var galleryarray = [img('http://lorempixel.com/400/100/'),
    //                     img('http://lorempixel.com/400/200/'),
    //                     img('http://lorempixel.com/400/300/'),
    //                     vid('http://www.w3schools.com/html/movie.mp4', 'http://www.w3schools.com/html/movie.ogg')
    //                    ];

                       console.log(galleryarray);
    var curimg = 1;

    function rotateimages() {
        $("#slideshow").fadeOut("slow");
        setTimeout(function () {
            curimg = (curimg < galleryarray.length - 1) ? curimg + 1 : 0
            document.getElementById('slideshow').innerHTML = '';
            galleryarray[curimg].style.width = "50%";
            galleryarray[curimg].style.height = "50%";
            document.getElementById('slideshow').appendChild(galleryarray[curimg]);
            if (galleryarray[curimg].tagName === "VIDEO") {
                if(galleryarray[curimg].paused) galleryarray[curimg].play();
            }
            $("#slideshow").fadeIn("slow");
        }, 1000);
    }
    </script>
    <script type="text/javascript">
        function initialize()
        {        
            $(document).ready(function() {
                $("#listencontainer").load("listenStop.php");
                var listenId = setInterval(function() {
                    $("#listencontainer").load('listenStop.php?randval='+ Math.random());
                                                       
                }, 1000);
                $.ajaxSetup({ cache: false});       
            }); 
        }    
    </script>
</body>

</html>
