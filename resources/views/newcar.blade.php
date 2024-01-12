<style>
    body {
    background-color: #f8f9fa;
}

.container {
    margin-top: 50px;
}

.well {
    background-color: #ffffff;
    box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
    padding: 30px;
    border-radius: 10px;
}

legend {
    font-size: 24px;
    color: #007bff; /* Same color as h1 in the existing color scheme */
    font-weight: bold;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-size: 16px;
    color: #007bff; /* Same color as h1 in the existing color scheme */
    font-weight: bold;
}

.form-control {
    border-radius: 5px;
    border: 1px solid #ced4da;
}

.input-group-addon {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 5px;
}

select {
    width: 100%;
    height: 34px;
    border-radius: 5px;
    border: 1px solid #ced4da;
}

button {
    background-color: #8894db;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    font-size: 18px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #5c69df;
}
</style>

<div class="container">

    <form class="well form-horizontal" method="post" id="car_form" action="{{route('car.create')}}">
        @csrf
        <fieldset>
\
            <legend>Add New Car</legend>

            <div class="form-group">
                <label class="col-md-4 control-label">Model</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="car_name" placeholder="Car Name" class="form-control" type="text" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Brand</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="car_brand" placeholder="Car Brand" class="form-control" type="text" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Build Year</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input name="build_year" placeholder="Build Year" class="form-control" type="number" min="1900"
                            max="2023" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Kilometers Driven</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-road"></i></span>
                        <input name="kilometers_driven" placeholder="Kilometers Driven" class="form-control"
                            type="number" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Price</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                        <input name="price" placeholder="Price" class="form-control" type="number" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Image URL</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                        <input name="img_url" id="img_url" placeholder="Image URL" class="form-control" type="url" onformchange="previewImage(this)" required >
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Gearbox Type</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-cog"></i></span>
                        <input name="gearbox_type" placeholder="Gearbox Type" class="form-control" type="text"
                            required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Fuel Type</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <select name="fuel_type" id="gasType" required>
                            <option value="" {{ empty(request('gasType')) ? 'selected' : '' }}>Any</option>
                            <option value="petrol" {{ request('gasType') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                            <option value="diesel" {{ request('gasType') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                            <option value="electric" {{ request('gasType') == 'electric' ? 'selected' : '' }}>Electric</option>
                            <option value="hybrid" {{ request('gasType') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label">Amount of Doors</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-modal-window"></i></span>
                        <input name="amount_of_doors" placeholder="Amount of Doors" class="form-control" type="number"
                            required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning" style="margin-top: 10px; margin-bottom: 10px;">
                        Add Car <span class="glyphicon glyphicon-send"></span>
                    </button>
                </div>
            </div>
        
        </fieldset>
    </form>
</div>