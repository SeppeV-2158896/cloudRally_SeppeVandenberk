<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Season Details</title>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>
        .team-list {
            list-style: none;
            padding: 0;
        }

        .team-item {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .team-name {
            font-weight: bold;
        }

        .team-info {
            margin-top: 10px;
        }

        .pilot-copilot-info {
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
                <div id="team-details">
                    <h2>Team Details:</h2>
            
                    <ul class="team-list" id="teamList">
                        <!-- Team items will be dynamically added here -->
                    </ul>
                </div>
            
                <script>       
                    // Function to populate the view with JSON data
                    function populateView(data) {
                        const teamList = document.getElementById('teamList');

                        
                        try {
                            // Try to loop through the first set of teams
                            data.data.team.forEach(team => {
                                const teamItem = document.createElement('li');
                                teamItem.className = 'team-item';

                                teamItem.innerHTML = `
                                    <p class="team-name">${team.name}</p>
                                    <div class="team-info">
                                        <p><strong>Pilot:</strong> ${team.pilot.first_name} ${team.pilot.last_name}</p>
                                        <p><strong>Copilot:</strong> ${team.copilot.first_name} ${team.copilot.last_name}</p>
                                        <p><strong>Car:</strong> ${team.car}</p>
                                    </div>
                                `;

                                teamList.appendChild(teamItem);
                            });
                        } catch (error) {
                            console.log('Could not find team');
                        }

                        try {
                            // Try to loop through the second set of teams
                            data.data.teams.forEach(team => {
                                const teamItem = document.createElement('li');
                                teamItem.className = 'team-item';

                                teamItem.innerHTML = `
                                    <p class="team-name">${team.name}</p>
                                    <div class="team-info">
                                        <p><strong>Pilot:</strong> ${team.pilot.first_name} ${team.pilot.last_name}</p>
                                        <p><strong>Copilot:</strong> ${team.copilot.first_name} ${team.copilot.last_name}</p>
                                        <p><strong>Car:</strong> ${team.car}</p>
                                    </div>
                                `;

                                teamList.appendChild(teamItem);
                            });
                        } catch (error) {
                            console.log('Could not find teams');
                        }  
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
