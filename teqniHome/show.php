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
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Custom Theme CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/glow.css">
   
    <!-- Advanced CSS -->
    <link href="css/animate.css" rel="stylesheet">
	<link href="js/lib/owl-carousel/owl.carousel.css" rel="stylesheet">
	<link href="js/lib/owl-carousel/owl.theme.css" rel="stylesheet">
	<link href="js/lib/owl-carousel/owl.transitions.css" rel="stylesheet">
	<link href="js/lib/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="js/lib/video/YTPlayer.css" rel="stylesheet">
    <link href="js/lib/flipclock/flipclock.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-custom" onload="initialize();">

	<!-- Navigation -->

   
    <!-- Intro Section -->
    <section id="intro">
    <div class="video-content">  
    <div class="video-image wp1 delay-1s">
    <div id="slideshow" class="img-responsive"></div>
    <textarea style="display:none;" id="imgSrc" >
        <?php
            while ($list = mysqli_fetch_assoc($result)) { 
                if ($list['timeDuration']!='0') { 
                    echo "img('".$list['imgPath']."'),";
                } 
            }
        ?>
    </textarea>
    <textarea style="display:none;" id="vidSrc" >
        <?php
            while ($listVid = mysqli_fetch_assoc($resultVid)) { 
                if ($listVid['timeDuration']=='0') { 
                    echo "'".$listVid['imgPath']."',";
                } 
            }
        ?>
    </textarea>
    </div>
    <input type="hidden" id="timeDuration" value="<?php
        while ($timeList = mysqli_fetch_assoc($timeResult)) {
            echo $timeList['timeDuration'].'000,';
        }
     ?>">

    </section><!-- /#intro --> 
    

   

    <div id="listencontainer"></div>
    <!-- Core JavaScript Files -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>

    <!-- JavaScript -->
    <script src="js/lib/jquery.appear.js"></script>
    <script src="js/lib/owl-carousel/owl.carousel.min.js"></script>
    <script src="js/lib/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="js/lib/video/jquery.mb.YTPlayer.js"></script> 		
    <script src="js/lib/flipclock/flipclock.js"></script>
    <script src="js/lib/jquery.animateNumber.js"></script>
    <script src="js/lib/waypoints.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/main.js"></script>
    <script>
        function img(src) {
            var el = document.createElement('img');
            el.src = src;
            return el;
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
                sliding = setInterval(rotateimages, 5000);
                rotateimages();
            };
            return el;
        }

        var imgSrc = document.getElementById("imgSrc").value;
        var imgEx = imgSrc.split(',');
        var vidSrc = document.getElementById("vidSrc").value;
        var vidEx = vidSrc.split(',');
        var vidAr = new Array();
        var galleryarray = new Array();
        for (var i = 0; i < vidEx.length - 1; i++) {
            vidAr[i] = vidEx[i];
        }
        vidSrc = "vid("+vidAr.toString()+")";
        
        for (var i = 0; i < imgEx.length - 1; i++) {
            galleryarray[i] = imgEx[i];
        }
        galleryarray.push(vidSrc);
        for (var i = 0; i < galleryarray.length; i++) {
            galleryarray[i] = galleryarray[i]..replace(/"/g, "");
        }
        console.log(galleryarray);
       // console.log(vidAr);

        // var galleryarray = [img('http://lorempixel.com/400/100/'),
        //                     img('http://lorempixel.com/400/200/'),
        //                     img('http://lorempixel.com/400/300/'),
        //                     vid('http://www.w3schools.com/html/movie.mp4', 'http://www.w3schools.com/html/movie.ogg')
        //                    ];
        var curimg = 1;

        function rotateimages() {
            $("#slideshow").fadeOut("slow");
            setTimeout(function () {
                curimg = (curimg < galleryarray.length - 1) ? curimg + 1 : 0
                document.getElementById('slideshow').innerHTML = '';
                galleryarray[curimg].style.width = "100%";
                galleryarray[curimg].style.height = "100%";
                document.getElementById('slideshow').appendChild(galleryarray[curimg]);
                if (galleryarray[curimg].tagName === "VIDEO") {
                    galleryarray[curimg].play();
                }
                $("#slideshow").fadeIn("slow");
            }, 1000);
        }

        var sliding;
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
