<!DOCTYPE html>
<html lang="en">
<head>
	<base target="_top">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Accessible markers - Leaflet</title>
	
	<link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='//api.tiles.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.3.1/leaflet-omnivore.min.js'></script>
    

	<style>
		html, body {
			height: 100%;
			margin: 0;
		}
		.leaflet-container {
			height: 400px;
			width: 600px;
			max-width: 100%;
			max-height: 100%;
		}
	</style>

	
</head>
<body>

<div id='map'></div>
<svg pointer-events="none" class="leaflet-zoom-animated" width="2304" height="506" style="transform: translate3d(-192px, 161px, 0px);" viewBox="-192 161 2304 506"><text dy="8" text-align="center" font-size="22px" fill="#FF0000"><textPath xlink:href="#pathdef-46">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;➔&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</textPath></text><text dy="8" text-align="center" font-size="22px" fill="#FF0000"><textPath xlink:href="#pathdef-51">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;➔&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</textPath></text><text dy="8" text-align="center" font-size="22px" fill="#FF0000"><textPath xlink:href="#pathdef-57">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;➔&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</textPath></text><g><path stroke="#FF0000" stroke-opacity="0.5" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="#FF0000" fill-opacity="0.5" fill-rule="evenodd" d="M975.4911657995544,530.2049771041493a3,3 0 1,0 6,0 a3,3 0 1,0 -6,0 "></path><path class="leaflet-interactive" stroke="#FF0000" stroke-opacity="0.5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M1158 490L1160 492L1165 493L1165 508L1174 510L1183 509L1189 512L1190 511L1192 505L1192 477L1182 470L1171 459L1186 441L1188 435L1178 430L1160 434L1159 427L1155 422L1146 418L1138 419L1138 405L1143 382L1158 392L1146 402L1159 411L1167 411L1176 408L1182 404L1183 402L1173 393L1170 388L1165 385L1166 382" id="pathdef-57"></path><path class="leaflet-interactive" stroke="#FF0000" stroke-opacity="0.5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M1269 275L1272 275L1274 271L1288 260L1279 253L1273 243L1270 242L1264 245L1272 272L1270 275L1272 275L1274 271L1287 261L1296 257L1300 253L1295 249L1287 236L1295 233L1306 233L1323 229L1316 214L1322 210L1341 202L1348 201L1351 202L1350 219L1353 227L1329 238L1316 242L1301 254L1308 264L1321 274L1280 275L1287 285L1323 316L1330 309L1332 301L1338 291L1360 304L1359 303L1366 294L1355 276L1359 275" id="pathdef-51"></path><path class="leaflet-interactive" stroke="#FF0000" stroke-opacity="0.5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M1034 531L1034 538L1037 541L1034 547L1033 555L1035 578L1044 569L1060 565L1066 562L1094 571L1091 589L1052 584L1043 597L1051 606L1085 617L1088 620L1108 658L1110 651L1118 640L1118 625L1120 615L1135 585L1140 578" id="pathdef-46"></path></g></svg>

<script>

	const map = L.map('map').setView([50.4501, 30.5234], 4);

	const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
		maxZoom: 19,
		attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
	}).addTo(map);

	//const marker = L.marker([50.4501, 30.5234], {alt: 'Kyiv'}).addTo(map)
		//.bindPopup('Kyiv, Ukraine is the birthplace of Leaflet!');

    //var kmlData = omnivore.kml('parcours/Rally_Zuid-Limburg.kml').addTo(map);

    
</script>



</body>
</html>
