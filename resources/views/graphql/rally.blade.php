<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Season Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .rally-details {
            max-width: 600px;
            margin: 0 auto;
        }

        .winner-info, .second-place-info, .third-place-info {
            border: 1px solid #ddd;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <div id="result-container">
        <h2>Rally Result:</h2>
        @php
            // Retrieve the 'result' query parameter from the URL
            $resultJson = request()->query('result');
            // Parse the JSON data
            $result = json_decode($resultJson, true);
        @endphp

        @if ($result)
                
            <body>
                <div class="rally-details">
                    <h1>{{ $result['data']['rally'][0]['name'] }}</h1>
                    <p>Start Date: {{ $result['data']['rally'][0]['start_date'] }}</p>
                    <p>Location: {{ $result['data']['rally'][0]['location'] }}</p>
    
                    <div class="winner-info">
                        <h3>Winner</h3>
                        <p>Name: {{ $result['data']['rally'][0]['winner']['name'] }}</p>
                    </div>
    
                    <div class="second-place-info">
                        <h3>Second Place</h3>
                        <p>Name: {{ $result['data']['rally'][0]['second_place']['name'] }}</p>
                    </div>
    
                    <div class="third-place-info">
                        <h3>Third Place</h3>
                        <p>Name: {{ $result['data']['rally'][0]['third_place']['name'] }}</p>
                    </div>
                </div>
            </body>
        @else
            <p>No result data available.</p>
        @endif
    </div>

</body>

</html>
