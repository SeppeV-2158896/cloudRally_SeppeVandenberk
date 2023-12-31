<div class="container">

    <form class="well form-horizontal" method="post" id="car_form" action="{{route('car.create')}}">
        @csrf
        <fieldset>

            <!-- Form Name -->
            <legend>Add New Car</legend>

            <!-- Text input -->
            <div class="form-group">
                <label class="col-md-4 control-label">Model</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="car_name" placeholder="Car Name" class="form-control" type="text" required>
                    </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group">
                <label class="col-md-4 control-label">Brand</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input name="car_brand" placeholder="Car Brand" class="form-control" type="text" required>
                    </div>
                </div>
            </div>

            <!-- Text input -->
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

            <!-- Text input -->
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

            <!-- Text input -->
            <div class="form-group">
                <label class="col-md-4 control-label">Price</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                        <input name="price" placeholder="Price" class="form-control" type="number" required>
                    </div>
                </div>
            </div>

            <!-- Text input -->
            <div class="form-group">
                <label class="col-md-4 control-label">Image URL</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
                        <input name="img_url" placeholder="Image URL" class="form-control" type="url" required>
                    </div>
                </div>
            </div>

            <!-- Text input -->
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

            <!-- Text input -->
            <div class="form-group">
                <label class="col-md-4 control-label">Fuel Type</label>
                <div class="col-md-4 inputGroupContainer">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-fire"></i></span>
                        <input name="fuel_type" placeholder="Fuel Type" class="form-control" type="text" required>
                    </div>
                </div>
            </div>

            <!-- Text input -->
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

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning">Add Car <span
                            class="glyphicon glyphicon-send"></span></button>
                </div>
            </div>

        </fieldset>
    </form>
</div>
