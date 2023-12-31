<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rally Car Marketplace</title>
    <link rel="stylesheet" href={{ asset('css/marketplace.css')}}>
    <style>
        
        .tile-view-row {
            display: flex;
            flex-wrap: wrap;
        }

        .tile {
            position: relative;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px;
            width: 200px;
            height: 300px;
            cursor: pointer;
            perspective: 1000px; /* Enable 3D effect */
        }

        .tile:hover .card {
            transform: rotateY(180deg); /* Flip the card on hover */
        }

        .card {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            transition: transform 0.6s;
        }

        .front, .back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden; /* Hide the backface */
        }

        .back {
            transform: rotateY(180deg);
            background-color: #c8e6c9; /* Back face color */
            padding: 10px;
            color: #333; /* Change the text color to a darker color, e.g., black (#000) or a dark gray (#333) */
        }

        .car-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .details {
            padding: 10px;
            margin-top: 10px;
        }

        .sold-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 0, 0, 0.5); /* Semi-transparent red */
            display: none;
            justify-content: center;
            align-items: center;
            font-size: 1.5em;
            color: #fff;
        }

        .tile.sold .sold-overlay {
            display: flex;
        }
    </style>
</head>
<body>

    <h1>Rally Car Marketplace</h1>

    <div class="tile-view-row">
        @foreach ($cars as $car)
            <div class="tile {{ $car->sold ? 'sold' : '' }}" onclick="showDetails('details{{$car->id}}')">
                <div class="card">
                    <div class="front">
                        <img src="{{$car->imgURL}}" alt="{{$car->name}}" class="car-image">
                        <h3>{{$car->carBrand}} {{$car->name}}</h3>
                        <p>Build Year: {{$car->buildYear}}</p>
                        <p>Kilometers Driven: {{$car->kilometersDriven}}</p>
                        <!-- Other tile content here -->
                    </div>
                    <div class="back">
                        <!-- Sold overlay on back face -->
                        @if ($car->sold)
                            <div class="sold-overlay">Sold</div>
                        @endif

                        <!-- Details container on back face -->
                        <div id="details{{$car->id}}" class="details">
                            <p>Price: {{$car->price}}</p>
                            <p>Gearbox Type: {{$car->gearboxType}}</p>
                            <p>Fuel Type: {{$car->fuelType}}</p>
                            <p>Amount of Doors: {{$car->amountOfDoors}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function showDetails(detailsId) {
            var details = document.getElementById(detailsId);
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        }
    </script>

</body>
</html>
