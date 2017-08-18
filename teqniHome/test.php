<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
</head>
<body>
<div id="slideshow" class="img-responsive"></div>
<script type="text/javascript">
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

	var galleryarray = [img('http://lorempixel.com/400/100/'),
	                    img('http://lorempixel.com/400/200/'),
	                    img('http://lorempixel.com/400/300/'),
	                    vid('http://www.w3schools.com/html/movie.mp4', 'http://www.w3schools.com/html/movie.ogg')
	                   ];
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
</body>
</html>