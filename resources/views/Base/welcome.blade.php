<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rally Racing Services</title>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .tile {
            background-color: #ffffff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin: 20px;
            width: 300px;
            text-align: center;
        }
    </style>
  </head>
  <body>
    <header>
      <h1>Rally Racing Services</h1>
    </header>
    <div class="container">
      <div class="tile">
        <h2>Calendar (SOAP)</h2>
        <p>Used for managing race schedules and retrieving race information of past and future rallies.</p>
        <a href='{{ route('callSoapService') }}'>Learn More</a>
      </div>
      <div class="tile">
        <h2>Car Telemetry (MQTT)</h2>
        <p>Enables real-time telemetry data from rally cars during races.</p>
        <a href='{{ route('telemetry') }}'>Learn More</a>
      </div>
      <div class="tile">
        <h2>WRC Results (GraphQL)</h2>
        <p>Manages race results, participants, competitions, cars, and race history.</p>
        <a href='{{ route('graphqlSearch') }}'>Learn More</a>
      </div>
      <div class="tile">
        <h2>Rally Marketplace (REST)</h2>
        <p>Provides a database of rally race cars for buying and selling.</p>
        <a href='{{ route('marketplace') }}'>Learn More</a>
      </div>
      <div class="tile">
        <h2>Cloud Rally Communication (WebSockets)</h2>
        <p>Enables communication between pilots, copilots, and engineers during races.</p>
        <a href='{{ route('chat') }}'>Learn More</a>
      </div>
    </div>
  </body>
</html>