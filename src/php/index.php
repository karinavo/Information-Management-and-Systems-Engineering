<!DOCTYPE html>


<html>
<title>Die Kochschule</title>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--icon-->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /*text style*/
        h1 {
            font-family:  "TeX Gyre ", serif; /* Гарнитура текста */
            font-size: 65%; /* Размер шрифта в процентах */
        }

    </style>
    <!--Dropdown botton-->
    <style>
        body {
            font-family:  "TeX Gyre ", serif;
        }

        .sidenav{
            height: 100%;
            width:200px;
            position: fixed;
            z-index: 1;
            top:0;
            left: 0;
            background-color:#4d4d4d ;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .dropdown-btn {
            float: left;
            overflow: hidden;
        }
        .dropdown .dropdown-btn {
            padding: 0px 0px 0px 6px;
            text-decoration: none;
            font-size: 20px;
            color: bisque;
            display:block;
            border:  bisque;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
            overflow: hidden;
            margin-left: 0px;
            margin-right: 0px;
        }
        /* Style the sidenav links and the dropdown button */
        .sidenav a, .dropdown-btn{
            padding: 6px 8px 6px 16px;
            overflow: hidden;
            text-decoration: none;
            font-size: 20px;
            color: bisque;
            display:block;
            border:  bisque;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            outline: none;
            margin: 0;
        }

        .sidenav a:hover,.dropdown-btn:hover{
            color: bisque;
        }
        .main{
            margin-left: 200px; /* Same as the width of the sidenav */
            font-size: 20px; /* Increased text to enable scrolling */
            padding: 0px 10px;
        }
        .dropdown-content {
            display: none;
            background-color: #4d4d4d;
            min-width: 200px;
        }

        .dropdown-content a {
            float: none;
            color: bisque;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #4d4d4d;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-container{
            display: none;
            background-color: #4d4d4d;
            padding-left:8px;
        }
        .fa-caret-down{
            display: none;
            float: right;
            padding-right: 8px;
        }

        @media screen and(max-height: 450px){
            .sidenav{padding-top: 15px;}
            .sidenav a {font-size: 18px;}

        }

    </style>
    <style>
        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
    <img src="Culinary.png" alt="Cooking courses logo" style="width:200px;height:200px;" class="center" align="top">
    <style>
        p.oblique {
            font-style:oblique;
        }
        div.a{
            text-align: center;
        }
    </style>
    <div class="a">
    <p class="oblique" > Die Kochschule</p>
    </div>


    <!--Dropdown botton-->
    <style>

        /**Slideshow*/

        * {box-sizing:border-box }
        body {sans-serif; margin:0}
        .mySlides {display: none}
        img {vertical-align: middle;}

        /* Slideshow container */
        .slideshow-container {
            max-width: 1000px;
            position: relative ;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            margin-top: -22px;
            padding: 16px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text {
            color: #ef5b20;
            font-size: 20px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: whitesmoke;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* The dots/bullets/indicators */
        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover {
            background-color: #717171;
        }

        /* Fading animation */
        .fade {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        @keyframes fade {
            from {opacity: .4}
            to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) {
            .prev, .next,.text {font-size: 11px}
        }
    </style>


</head>


<body>
<!--background-->
<div class="sidenav">
    <div class="dropdown">
     <button class="dropdown-btn"> &#9778
        <i class="fa fa-caret-down"></i>
     </button>
     <div class="dropdown-content" style="margin-left: 6%">
        <a href="index.php">Home</a>
        <a href="kueche.php">Küche</a>
        <a href="kochkurse.php">Kochkurse</a>
        <a href="koch.php">Unsere Köche</a>
        <a href="findetstatt.php">Termine</a>
        <a href="fuehrt.php">Fuehrung</a>
        <a href="kursteilnehmer.php">Kursteilnehmer</a>
        <a href="mitarbeiter.php">Mitarbeiter</a>
     </div>
    </div>
</div>
<div class="main">
    <!--Slideshow-->
    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <a href="http://localhost:8080/kochkurse.php?search=Alles+Wok">
                 WOK Kurse <img src="Wok.jpg" style="width:100%"></a>
            <div class="text">Alles WOK!</div>
        </div>
        <div class="mySlides fade">
            <div class="numbertext"></div>
            <a href="http://localhost:8080/kochkurse.php?search=Ganz+schoen+Wild">
                Ganz schön Wild<img src="Wild.jpg" style="width:100%"></a>
            <div class="text">Ganz schön Wild!</div>
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
           <a href="http://localhost:8080/kochkurse.php?search=Festlicher+Osterbrunch">
                Osterbrunch<img src="Osterbuffet.jpg" style="width:100%"> </a>
            <div class="text">Festlicher Osterbrunch!</div>
        </div>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
    <br>

    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
    </div>

    <script>
        var slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
    </script>
</div>



</body>
</html>
