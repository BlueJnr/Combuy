<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/stilo.css">
    <link href="image/favicon_logo.ico" rel="icon">
    <title>NO AUTORIZADO</title>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<div class="gifty">
    <img src="image\no.gif">
</div>

<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" " class="filterwrapper">
    <defs>
        <svg id="glitchmask-r" width="100%"  viewbox="0 0 100 100" preserveAspectRatio="none">
            <line class="top-r" x1="0" y1="0" x2="100%" y2="0"> </line>
            <line class="bot-r" x1="0" y1="100%" x2="100%" y2="100%"></line>
        </svg>
        <svg id="glitchmask-g" width="100%"  viewbox="0 0 100 100" preserveAspectRatio="none">
            <line class="top-g" x1="0" y1="0" x2="100%" y2="0"></line>
            <line class="bot-g" x1="0" y1="100%" x2="100%" y2="100%"></line>
        </svg>

        <filter color-interpolation-filters="sRGB" id="filter" width="100%" heigth="100%" x="0" y="0">
            <feFlood flood-color="#deebff" result="black" />

            <!-- red text start -->
            <feFlood flood-color="red" result="REDTXT_FLOOD_10" />
            <feComposite operator="in" in="REDTXT_FLOOD_10" in2="SourceAlpha" result="REDTXT_COMP_20" />
            <feOffset in="SourceGraphic" dx="-2" dy="0" result="REDTXT_OFFSET_30" />
            <feMerge result="REDTXT_MERGE_40">
                <feMergeNode in="black" />
                <feMergeNode in="REDTXT_COMP_20" />
                <feMergeNode in="REDTXT_OFFSET_30" />
            </feMerge>
            <feImage preserveAspectRatio="none" id="mask-r" result="REDTXT_IMG_50" xlink:href="#glitchmask-r" />
            <feComposite in2="REDTXT_IMG_50" in="REDTXT_MERGE_40" operator="out" result="REDTXT_COMP_60" />
            <!-- red text end -->

            <!-- green text start -->
            <feFlood flood-color="limegreen" result="GREENTXT_FLOOD_10" />
            <feComposite operator="in" in="GREENTXT_FLOOD_10" in2="SourceAlpha" result="GREENTXT_COMP_20" />
            <feOffset in="SourceGraphic" dx="2" dy="0" result="GREENTXT_OFFSET_30" />
            <feMerge result="GREENTXT_MERGE_40">
                <feMergeNode in="black" />
                <feMergeNode in="GREENTXT_COMP_20" />
                <feMergeNode in="GREENTXT_OFFSET_30" />
            </feMerge>
            <feImage preserveAspectRatio="none" id="mask-g" result="GREENTXT_IMG_50" xlink:href="#glitchmask-g" />
            <feComposite in2="GREENTXT_IMG_50" in="GREENTXT_MERGE_40" operator="out" result="GREENTXT_COMP_60" />
            <!-- green text end -->

            <feMerge result="MERGE_10">
                <feMergeNode in="SourceGraphic" />
                <feMergeNode in="REDTXT_COMP_60" />
                <feMergeNode in="GREENTXT_COMP_60" />
            </feMerge>
        </filter>
    </defs>
</svg>
<figure class="glitch-filter-example">
    <svg class="glitch-filter-example__demo" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%">
        <text class="glitch-filter-example__filtered-text" y="50%" text-anchor="middle" x="50%" transform="translate(0 34)">NO TIENES PERMISO COMO USUARIO :)!!!</text>
    </svg>
</figure>

<script src="js/scrip.js"></script>
</body>
</html>