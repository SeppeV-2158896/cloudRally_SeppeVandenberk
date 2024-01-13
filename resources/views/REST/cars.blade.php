<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rally Car Marketplace</title>
    <link rel="stylesheet" href={{ asset('css/styles.css')}}>
    <link rel="stylesheet" href={{ asset('css/generic.css')}}>
    <style>
        
        body {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        padding: 20px;
        margin: 0;
    }

    .filter-box {
        width: 300px;
        max-width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        position: fixed;
        top: 25%;
        left: 0;
        height: 100vh; /* 100% of the viewport height */
        overflow-y: auto; /* Add scroll if needed */
        z-index: 1; /* Ensure it appears above other elements */
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
    }

    .tile-view-row {
        display: flex;
        flex-wrap: wrap;
        width: calc(100% - 340px);
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

    <div class="filter-box">
        <h2>Filters</h2>
        <form action="{{ route('filtered') }}" method="GET" class="filter-form">
            <label for="minPrice">Min Price:</label>
            <input type="number" name="minPrice" id="minPrice" value="{{ request('minPrice') }}" placeholder="Enter Min Price">

            <label for="maxPrice">Max Price:</label>
            <input type="number" name="maxPrice" id="maxPrice" value="{{ request('maxPrice') }}" placeholder="Enter Max Price">

            <label for="kilometersRange">Kilometers:</label>
            <div class="range-container">
                <input type="range" name="kilometersRange" id="kilometersRange" min="0" max="250000" value="{{ request('kilometersRange') }}">
                <span id="kilometersValue">{{ request('kilometersRange') }}</span>
            </div>

            <label for="brand">Brand:</label>
            <input type="text" name="brand" id="brand" value="{{ request('brand') }}" placeholder="Enter Brand">

            <label for="model">Model:</label>
            <input type="text" name="model" id="model" value="{{ request('model') }}" placeholder="Enter Model">

            <label for="gasType">Gas Type:</label>
            <select name="gasType" id="gasType">
                <option value="" {{ empty(request('gasType')) ? 'selected' : '' }}>Any</option>
                <option value="petrol" {{ request('gasType') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                <option value="diesel" {{ request('gasType') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                <option value="electric" {{ request('gasType') == 'electric' ? 'selected' : '' }}>Electric</option>
                <option value="hybrid" {{ request('gasType') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>

            <div class="button-container">
                <button type="submit">Search</button>
                <button type="button" onclick="window.location.href='{{ route('marketplace') }}'">Reset</button>
                
            </div>

        </form>

        <h2>Sell your own car</h2>

        <button type="button" onclick="window.location.href='{{ route('newCar') }}'">Sell A Car</button>
    </div>

    <div class="tile-view-row">
        @foreach ($cars as $car)
            <div class="tile {{ $car->sold ? 'sold' : '' }}" >
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
        var tileElements = document.querySelectorAll('.tile');

        tileElements.forEach(function(tileElement) {
            var cardElement = tileElement.querySelector('.card');
            var isFlipped = false;

            tileElement.addEventListener('click', function() {
                if (isFlipped) {
                    cardElement.style.transform = 'rotateY(0deg)';
                } else {
                    cardElement.style.transform = 'rotateY(180deg)';
                }

                isFlipped = !isFlipped;
            });
        });

        var kilometersRange = document.getElementById('kilometersRange');
        var kilometersValue = document.getElementById('kilometersValue');
        kilometersValue.innerHTML = kilometersRange.value;

        kilometersRange.addEventListener('input', function () {
            kilometersValue.innerHTML = this.value;
        });
    </script>

</body>
</html>
