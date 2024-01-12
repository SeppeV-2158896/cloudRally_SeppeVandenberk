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

        .season-details {
            max-width: 600px;
            margin: 0 auto;
        }

        .rally-list {
            list-style: none;
            padding: 0;
        }

        .rally-item {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .rally-winner {
            font-weight: bold;
        }

        .pilot-name {
            font-style: italic;
        }
    </style>
</head>

<body>

    <div id="result-container">
        @php
            // Retrieve the 'result' query parameter from the URL
            $resultJson = request()->query('result');
            // Parse the JSON data
            $result = json_decode($resultJson, true);
        @endphp

        @if ($result)
                
            <body>
                <div class="season-details" id="seasonDetails">
                    <h1 id="yearHeader"></h1>
                    <p id="champion"></p>
                    <p id="constructorChampion"></p>
            
                    <ul class="rally-list" id="rallyList">
                        <!-- Rally items will be dynamically added here -->
                    </ul>
                </div>
            
                <script>       
                    // Function to populate the view with JSON data
                    function populateView(data) {
                        const seasonDetails = document.getElementById('seasonDetails');
                        const yearHeader = document.getElementById('yearHeader');
                        const champion = document.getElementById('champion');
                        const constructorChampion = document.getElementById('constructorChampion');
                        const rallyList = document.getElementById('rallyList');
            
                        const seasonData = data.data.season[0];
            
                        yearHeader.textContent = `Year: ${seasonData.year}`;
                        champion.textContent = `Champion: ${seasonData.champion}`;
                        constructorChampion.textContent = `Constructor Champion: ${seasonData.constructor_champion}`;
            
                        // Clear existing rally items
                        rallyList.innerHTML = '';
            
                        // Add rally items
                        seasonData.rallies.forEach(rally => {
                            const rallyItem = document.createElement('li');
                            rallyItem.className = 'rally-item';
            
                            rallyItem.innerHTML = `
                                <h3>${rally.name}</h3>
                                <p class="rally-winner">Winner: ${rally.winner.name}</p>
                                <p class="pilot-name">Pilot: ${rally.winner.pilot.first_name}</p>
                            `;
            
                            rallyList.appendChild(rallyItem);
                        });
                    }
            
                    // Call the function with the example JSON data
                    populateView(@json($result));
                </script>
            </body>
        @else
            <p>No result data available.</p>
        @endif
    </div>

</body>

</html>
