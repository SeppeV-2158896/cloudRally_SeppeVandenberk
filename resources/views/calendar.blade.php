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

    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

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
            <div id="details-container">
            </div>
        </div>
    </div>

    <script>
        fetch('/calendar/getAllRallies')
            .then(response => response.json())
            .then(data => {
                console.log('Data:', data); // Log the entire data object to the console
                createMap(data.response);
                createRallyDetails(data.response);
            })
            .catch(error => console.error('Error fetching data:', error));

        function createMap(data) {
            var map = L.map('map').setView([0, 0], 2); 

            // Add OpenStreetMap as the base layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var rallyMarkers = new Map();

            var rallyArray = Array.isArray(data.rally) ? data.rally : [data.rally]; // Ensure we have an array
            rallyArray.forEach(rally => {
                console.log('Rally:', rally);
            
                var locationKey = rally.service.latitude + ',' + rally.service.longitude;

                if (!rallyMarkers.has(locationKey)) {
                    rallyMarkers.set(locationKey, L.marker([rally.service.latitude, rally.service.longitude])
                        .addTo(map)
                        .bindPopup(rally.name));
                } else {
                    var marker = rallyMarkers.get(locationKey);
                    var popupContent = marker.getPopup().getContent();
                    popupContent += '<br>' + rally.name;
                    marker.setPopupContent(popupContent);
                }

                rallyMarkers.get(locationKey).on('click', function () {
                    showLocalRally(rally);
                });
            });
        }

        function showLocalRally(rally){
            fetch('/calendar/getAllFutureRallies')
            .then(response => response.json())
            .then(data => {
                console.log('Data:', data); // Log the entire data object to the console
                createRallyDetails(data.response);
            })
            .catch(error => console.error('Error fetching data:', error));
        }

        // Function to create rally details in the sidebar
        function createRallyDetails(data) {
            var detailsContainer = document.getElementById('details-container');

            detailsContainer.children().remove();

            var rallyArray = Array.isArray(data.rally) ? data.rally : [data.rally]; // Ensure we have an array
            rallyArray.forEach(rally => {
                console.log('Rally:', rally);
                var details = document.createElement('div');
                details.className = 'rally-details';
                details.textContent = rally.name;

                // Add click event to display rally details
                details.addEventListener('click', function () {
                    showRallyDetails(rally);
                });

                detailsContainer.appendChild(details);
            });
        }

        // Function to show rally details in the sidebar
        function showRallyDetails(rally) {
            var detailsContainer = document.getElementById('details-container');
            detailsContainer.innerHTML = '<h2>' + rally.name + '</h2>' +
                '<p>Latitude: ' + rally.service.latitude + '</p>' +
                '<p>Longitude: ' + rally.service.longitude + '</p>';
        }
    </script>
</body>
</html>
