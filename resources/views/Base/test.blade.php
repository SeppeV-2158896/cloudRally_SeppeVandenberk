<!DOCTYPE html>
<html>
<head>
    <title>Car Dashboard</title>
    <script src='https://cdn.plot.ly/plotly-2.27.0.min.js'></script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
         body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 10px;
        }

        .gauge {
            width: 600px;
            height: 500px;
            background-color: lightgray;
            border: 1px solid darkgray;
        }

        #map {
            height: 300px;
            width: 80%;
            margin: 20px 0;
        }

        .container {
            position: relative;
            text-align: center;
            color: white;
            }

            /* Bottom left text */
        .tyre-pressure_bl {
            position: absolute;
            color: rgb(0, 0, 0);
            font-weight: bold;
            bottom: 150px;
            left: 100px;
            }

            /* Top left text */
        .tyre-pressure_tl {
            position: absolute;
            color: rgb(0, 0, 0);
            font-weight: bold;
            top: 150px;
            left: 100px;
            }

            /* Top right text */
        .tyre-pressure_tr {
            position: absolute;
            color: rgb(0, 0, 0);
            font-weight: bold;
            top: 150px;
            right: 100px;
            }

            /* Bottom right text */
        .tyre-pressure_br {
            position: absolute;
            color: rgb(0, 0, 0);
            font-weight: bold;
            bottom: 150px;
            right: 100px;
            }

    </style>
</head>
<body>
    <h1>Car Dashboard</h1>
    
    <div class="form-group">
        <label>Speed:</label>
        <div id="speedGauge" class="gauge"></div>
    </div>

    <div class="form-group">
        <label>Fuel Level:</label>
        <div id="fuelGauge" class="gauge"></div>
    </div>
    
    <div id="map"></div>

    <div class="container">
        <img src="https://www.shutterstock.com/image-vector/vector-top-view-car-vehicle-600nw-724653760.jpg" alt="Car Image">
        <div class="tyre-pressure_tl" id="tlPressure"></div>
        <div class="tyre-pressure_tr" id="trPressure"></div>
        <div class="tyre-pressure_bl" id="blPressure"></div>
        <div class="tyre-pressure_br" id="brPressure"></div>
    </div> 



    <script>

        const clientId = 'mqttjs_' + Math.random().toString(16).substr(2, 8);
        const host = 'ws://localhost:8083/mqtt';
        const options = {
            keepalive: 60,
            clientId: clientId,
            protocolId: 'MQTT',
            protocolVersion: 4,
            clean: true,
            reconnectPeriod: 1000,
            connectTimeout: 30 * 1000,
            will: {
            topic: 'WillMsg',
            payload: 'Connection Closed abnormally..!',
            qos: 0,
            retain: false
            },
        }

        var carNumber = 85;
        var client = mqtt.connect(host,options);

        client.on('connect', function(){
            console.log("Connected");

            client.subscribe(`data/car${carNumber}`, function (err) {
                if (!err) {
                    console.log(`Subscribed to data/car${carNumber}`);
                }
            });

            client.publish(`data/car${carNumber}`, JSON.stringify({'data' : 'Connected'}));
        })

        client.on('error', function (error) {
            console.log(error);
        });

        client.on('message', (topic, message) => {
            console.log("message received")
            
            var jsonData = JSON.parse(message);
            console.log(jsonData);
            if (jsonData.data == null){
                updateGauge('fuelGauge', jsonData.fuelLevel, 100);
                updateGauge('speedGauge', jsonData.speed, 250);
                updateTyrePressure(jsonData.tyrePressure);
                updateMap(jsonData.location);
            }
        });

        function updateGauge(elementId, value, max) {
            var data = [
                {
                    domain: { x: [0, 1], y: [0, 1] },
                    value: value,
                    type: "indicator",
                    mode: "gauge+number",
                    gauge: {
                        axis: { range: [null, max] }
                    }
                }
            ];

            var layout = { width: 600, height: 500, margin: { t: 0, b: 0 } };
            Plotly.newPlot(elementId, data, layout);
        }

        var map, marker;
        function updateMap(location) {
            if (!map) {
                map = L.map('map').setView([location.latitude, location.longitude], 16);
                marker = L.marker([location.latitude, location.longitude]).addTo(map);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);
            } else {
                marker.setLatLng([location.latitude, location.longitude]);
                map.panTo([location.latitude, location.longitude]);
            }
        }

        function updateTyrePressure(tyrePressure) {
            document.getElementById('tlPressure').innerText = `TL: ${tyrePressure.tl} PSI`;
            document.getElementById('trPressure').innerText = `TR: ${tyrePressure.tr} PSI`;
            document.getElementById('blPressure').innerText = `BL: ${tyrePressure.bl} PSI`;
            document.getElementById('brPressure').innerText = `BR: ${tyrePressure.br} PSI`;
        }

    </script>
</body>
</html>
