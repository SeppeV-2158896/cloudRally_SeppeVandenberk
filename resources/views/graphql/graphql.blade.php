<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraphQL Playground</title>
    <script src="{{ asset('js/graphql_queries.js') }}"></script>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <container>
    <label for="querySelect">Select a GraphQL Query:</label>
    <select id="querySelect">
        <option value="getAllTeams">Get All Teams</option>
        <option value="getAllTeamsWithParticipants">Get All Teams with Participants</option>
        <option value="getAllPodiums">Get All Podiums</option>
        <option value="getRallyByName">Get Rally by Name</option>
        <option value="getParticipantsByNames">Get Participants by Names</option>
        <option value="getTeamByName">Get Team by Name</option>
        <option value="getSeasonByYear">Get Season by Year</option>
    </select>
    <br>

    <div id="queryForm"></div>
    <br>

    <button onclick="loadSelectedQuery()">Load Query</button>
    <button onclick="executeQuery()">Run Query</button>
    <br>

    
    </container>

    <pre id="result"></pre>
    <script>
        function loadSelectedQuery() {
            const selectedQuery = document.getElementById('querySelect').value;
            document.getElementById('queryForm').innerHTML = window[selectedQuery + 'Form']();
        }

        function getAllTeamsForm() {
            return ``;
        }

        function getAllTeamsWithParticipantsForm() {
            return ``;
        }

        function getAllParticipantsWithTeamsForm() {
            return ``;
        }

        function getAllPodiumsForm() {
            return ``;
        }

        function getRallyByNameForm() {
            return `
            <label for="rallyName">Enter Rally Name:</label>
            <input type="text" id="rallyName" name="rallyName">
            `;
        }

        function getParticipantsByNamesForm() {
            return `
            <label for="firstName">Enter First Name:</label>
            <input type="text" id="firstName" name="firstName">
            <br>
            <label for="lastName">Enter Last Name:</label>
            <input type="text" id="lastName" name="lastName">
            `;
        }

        function getTeamByNameForm() {
            return `
            <label for="teamName">Enter Team Name:</label>
            <input type="text" id="teamName" name="teamName">
            `;
        }

        function getSeasonByYearForm() {
            return `
            <label for="year">Enter Year:</label>
            <input type="text" id="year" name="year">
            `;
        }

        async function executeQuery() {
            const selectedQuery = document.getElementById('querySelect').value;

            // Retrieve form values based on the selected query
            let formValues;
            switch (selectedQuery) {
                case 'getRallyByName':
                    formValues = document.getElementById('rallyName').value;
                    break;
                case 'getParticipantsByNames':
                    firstName = document.getElementById('firstName').value;
                    lastName = document.getElementById('lastName').value;
                    formValues = JSON.stringify({'firstname' : firstName, 'lastname' :  lastName});
                    break;
                case 'getTeamByName':
                    formValues = document.getElementById('teamName').value;
                    break;
                case 'getSeasonByYear':
                    formValues = document.getElementById('year').value;
                    break;
            }

            console.log(window[selectedQuery](formValues));

            const response = await fetch('/graphql', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ query: window[selectedQuery](formValues) }),
            });

            const result = await response.json();
            console.log(JSON.stringify(result));
            //document.getElementById('result').innerText = JSON.stringify(result, null, 2);

            window.location.href = '/wrc/graphql/' + [selectedQuery] + '?result=' + encodeURIComponent(JSON.stringify(result));
        }
    </script>
</body>

</html>
