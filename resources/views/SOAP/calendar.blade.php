<!-- resources/views/calendar.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>

    <!-- Include Leaflet CSS and JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/leaflet-omnivore/leaflet-omnivore.min.js"></script>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>

        #map-container {
            position: relative;
            height: 100vh;
        }

        #map {
            height: 100%;
            width: 75%;
            float: left;
        }

        #sidebar {
            height: 100%;
            width: 25%;
            float: left;
            background-color: #f4f4f4;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        #details-container {
            margin-top: 20px;
        }

        .rally-details {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .rally-details:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div id="map-container">
        <div id="map"></div>
        <div id="sidebar">
            <h1>Calendar</h1>
            <button onclick="showFutureRallies()">Show Future Rallies</button>
            <div id="details-container">
            </div>
        </div>
    </div>

    <script>
        var map; // Declare map variable outside functions to make it accessible
    
        fetch('/calendar/getAllRallies')
            .then(response => response.json())
            .then(data => {
                console.log('Data:', data);
                createMap(data.response);
                createRallyDetails(data.response);
            })
            .catch(error => console.error('Error fetching data:', error));
    
        function createMap(data) {
            map = L.map('map').setView([0, 0], 2);
    
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);
    
            var rallyMarkers = new Map();
    
            var rallyArray = Array.isArray(data.rally) ? data.rally : [data.rally];
            rallyArray.forEach(rally => {
                var locationKey = rally.service.latitude + ',' + rally.service.longitude;
    
                if (!rallyMarkers.has(locationKey)) {
                    rallyMarkers.set(locationKey, L.marker([rally.service.latitude, rally.service.longitude])
                        .addTo(map)
                        .bindPopup(rally.name));
    
                    rallyMarkers.get(locationKey).on('click', function () {
                        showLocalRally(rally);
                    });
                } else {
                    var marker = rallyMarkers.get(locationKey);
                    var popupContent = marker.getPopup().getContent();
                    popupContent += '<br>' + rally.name;
                    marker.setPopupContent(popupContent);
                }
            });
        }
    
        function showLocalRally(rally) {
            var detailsContainer = document.getElementById('details-container');
            detailsContainer.innerHTML = "";
    
            var url = `/calendar/getRalliesByLocation/${rally.service.longitude}/${rally.service.latitude}`;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log('Data:', data);
                    createRallyDetails(data.response);
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    
        function showFutureRallies() {
            var detailsContainer = document.getElementById('details-container');
            detailsContainer.innerHTML = "";
    
            fetch('/calendar/getAllFutureRallies')
                .then(response => response.json())
                .then(data => {
                    console.log('Data:', data);
                    createRallyDetails(data.response);
                })
                .catch(error => console.error('Error fetching data:', error));
        }
    
        function createRallyDetails(data) {
            var detailsContainer = document.getElementById('details-container');
    
            var rallyArray = Array.isArray(data.rally) ? data.rally : [data.rally];
            rallyArray.forEach(rally => {
                var details = document.createElement('div');
                details.className = 'rally-details';
                details.textContent = rally.name;
    
                details.addEventListener('click', function () {
                    showRallyDetails(rally);
                });
    
                detailsContainer.appendChild(details);
            });
        }
    
        function showRallyDetails(rally) {
            var url = `/calendar/getRallyByName/${encodeURIComponent(rally.name)}`;
    
            return fetch(url)
                .then(response => response.json())
                .then(data => {
                    console.log('Data:', data);
    
                    var detailsContainer = document.getElementById('details-container');
                    detailsContainer.innerHTML = '<h2>' + data.response.rally.name + '</h2>' +
                        '<p>Country: ' + data.response.rally.country + '</p>' +
                        '<p>Date: ' + data.response.rally.date.year + '-' + data.response.rally.date.month + '-' + data.response.rally.date.day + '</p>' +
                        '<p>Latitude: ' + data.response.rally.service.latitude + '</p>' +
                        '<p>Longitude: ' + data.response.rally.service.longitude + '</p>' +
                        '<p>Website: <a href="' + data.response.rally.website + '" target="_blank">' + data.response.rally.website + '</a></p>' +
                        '<p>Results: <a href="' + data.response.rally.results + '" target="_blank">' + data.response.rally.results + '</a></p>' +
                        '<p>Amount of Stages: ' + data.response.rally.amount_of_stages + '</p>' +
                        '<p>Stages: <br>' + data.response.rally.stages.join('<br> ') + '</p>';
    
                    // Add KML layer
                    if (data.response.rally.maps) {
                        omnivore.kml('parcours/' + data.response.rally.maps + '.kml').addTo(map);
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    return 'Error fetching data';
                });
        }
    </script>
    
</body>
</html>
