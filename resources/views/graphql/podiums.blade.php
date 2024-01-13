<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Season Details</title>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>
        #rally-details {
            max-width: 600px;
            margin: 0 auto;
        }

        .rally-item {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .rally-info p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div> 
        @php
            // Retrieve the 'result' query parameter from the URL
            $resultJson = request()->query('result');
            // Parse the JSON data
            $result = json_decode($resultJson, true);
        @endphp

        @if ($result)

        <div id="rally-details">
            <h2>Rally Details:</h2>

            <ul class="rally-list" id="rallyList">
                <!-- Rally items will be dynamically added here -->
            </ul>
        </div>

        <script>
            // Function to populate the view with JSON data
            function populateView(data) {
                const rallyList = document.getElementById('rallyList');

                // Add rally items
                data.data.rallies.forEach(rally => {
                    const rallyItem = document.createElement('li');
                    rallyItem.className = 'rally-item';

                    // Assume each rally has name, winner, second_place, and third_place properties
                    rallyItem.innerHTML = `
                        <p class="rally-name">${rally.name}</p>
                        <div class="rally-info">
                            <p><strong>Winner:</strong> ${rally.winner.name}</p>
                            <p><strong>Second Place:</strong> ${rally.second_place.name}</p>
                            <p><strong>Third Place:</strong> ${rally.third_place.name}</p>
                        </div>
                    `;

                    rallyList.appendChild(rallyItem);
                });
            }

            populateView(@json($result));
        </script>

        @else
            <p>No result data available.</p>
        @endif
    </div>
</body>

</html>
