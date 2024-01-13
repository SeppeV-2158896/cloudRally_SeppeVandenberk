<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Season Details</title>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>
        .participant-list {
            list-style: none;
            padding: 0;
        }

        .participant-item {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .participant-name {
            font-weight: bold;
        }

        .participant-info {
            margin-top: 10px;
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
                <div id="participant-details">
                    <h2>Participant Details:</h2>
            
                    <ul class="participant-list" id="participantList">
                        <!-- Participant items will be dynamically added here -->
                    </ul>
                </div>
            
                <script>       
                    // Function to populate the view with JSON data
                    function populateView(data) {
                        const participantList = document.getElementById('participantList');

                        // Add participant items
                        data.data.participants.forEach(participant => {
                            const participantItem = document.createElement('li');
                            participantItem.className = 'participant-item';

                            participantItem.innerHTML = `
                                <p class="participant-name">${participant.first_name} ${participant.last_name}</p>
                                <div class="participant-info">
                                    <p><strong>Birthday:</strong> ${participant.birthday}</p>
                                </div>
                            `;

                            participantList.appendChild(participantItem);
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
