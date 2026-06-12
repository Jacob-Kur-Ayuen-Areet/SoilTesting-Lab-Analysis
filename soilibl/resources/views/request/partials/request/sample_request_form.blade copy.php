

<form id="farmer-info-form" action="{{ route('farmer-requests.store') }}" method="POST">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="">
                    <h4><b>Farmer Name:</b> {{$farmer_request->farmer->farmer_name}}</h4>

                </div>
                <div class="">
                    <h4>Phone Number: {{$farmer_request->farmer->contact_phone}}</h4>
                </div>
                <div class="">
                    <h4>Farm Name: {{ $farmer_request->farm->farm_name }}</h4>
                </div>

            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="">
                    <h4>Date Received:</h4>
                </div>
                <div class="">
                    <h4>Date Sampled: {{ $farmer_request->date_sampled }}</h4>
                </div>
                <div class="">
                    <h4>Number of Samples Collected:{{ $farmer_request->number_of_samples }}</h4>
                </div>
                <div class="">
                    <h4>Average Sub Samples Taken:{{ $farmer_request->average_sub_samples_taken }}</h4>
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="">
                    <h4>Date Received:</h4>
                </div>
                <div class="">
                    <h4>Date Sampled: {{ $farmer_request->date_sampled }}</h4>
                </div>
                <div class="">
                    <h4>Number of Samples Collected:{{ $farmer_request->number_of_samples }}</h4>
                </div>
                <div class="">
                    <h4>Average Sub Samples Taken:{{ $farmer_request->average_sub_samples_taken }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="farmer_name">Farmer Name</label>
                <input type="text" class="form-control" id="farmer_name"
                    value="{{ $farmer_request->farmer->farmer_name }}" name="farmer_name" required>
            </div>
            <div class="form-group">
                <label for="postal_address">Postal Address</label>
                <input type="text" class="form-control" id="postal_address"
                    value="{{ $farmer_request->farmer->postal_address }}" name="postal_address"
                    required>
            </div>
            <div class="form-group">
                <label for="province_id">Province</label>
                <input type="text" class="form-control" id="province_id"
                    value="{{ $farmer_request->farmer->province->name }}" name="province_id">
            </div>

            <div class="form-group">
                <label for="city_id">City</label>
                <input type="text" class="form-control" id="city_id"
                    value="{{ $farmer_request->farmer->city->city_name }}" name="city_id">
            </div>
            <div class="form-group">
                <label for="country_id">Country</label>
                <input type="text" class="form-control" id="country_id"
                    value="{{ $farmer_request->farmer->country->name }}" name="country_id">
            </div>


            <div class="form-group">
                <label for="contact_phone">Contact Phone</label>
                <input type="text" class="form-control" id="contact_phone"
                    value="{{ $farmer_request->farmer->contact_phone }}" name="contact_phone"
                    required>
            </div>
            <div class="form-group">
                <label for="receipt_number">Receipt Number</label>
                <input type="text" class="form-control" id="receipt_number"
                    value="{{ $farmer_request->receipt_number }}" name="receipt_number">
            </div>
            <div class="form-group">
                <label for="number_of_samples">Number of Samples</label>
                <input type="number" class="form-control" id="number_of_samples"
                    value="{{ $farmer_request->number_of_samples }}" name="number_of_samples"
                    required>
            </div>
            <div class="form-group">
                <label for="earliest_date_of_collection">Earliest Date of Collection</label>
                <input type="date" class="form-control" id="earliest_date_of_collection"
                    value="{{ $farmer_request->earliest_date_of_collection }}"
                    name="earliest_date_of_collection" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="farm_name">Farm Name</label>
                <input type="text" class="form-control" id="farm_name"
                    value="{{ $farmer_request->farm->farm_name }}" name="farm_name" required>
            </div>
            <div class="form-group">
                <label for="date_received">Date Received</label>
                <input type="date" class="form-control" id="date_received"
                    value="{{ $farmer_request->date_received }}" name="date_received" required>
            </div>
            <div class="form-group">
                <label for="date_sampled">Date Sampled</label>
                <input type="date" class="form-control" id="date_sampled"
                    value="{{ $farmer_request->date_sampled }}" name="date_sampled">
            </div>
            <div class="form-group">
                <label for="ica_locality">ICA Locality</label>
                <input type="text" class="form-control" id="ica_locality" name="ica_locality">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"
                    value="{{ $farmer_request->farmer->user->email }}" name="email">
            </div>
            <div class="form-group">
                <label for="advisor_name">Advisor Name</label>
                <input type="text" class="form-control" id="advisor_name"
                    value="{{ $farmer_request->advisor_name }}" name="advisor_name">
            </div>
            <div class="form-group">
                <label for="approved">Approved</label>
                <select type="checkbox" class="form-control" id="approved" name="approved">
                    <option value="N" value="{{ $farmer_request->approved }}"> Not Approved
                    </option>
                    <option value="Y">Approved</option>
                </select>
            </div>
            <div class="form-group">
                <label for="average_sub_samples_taken">Average Sub Samples Taken</label>
                <input type="number" class="form-control" id="average_sub_samples_taken"
                    value="{{ $farmer_request->average_sub_samples_taken }}"
                    name="average_sub_samples_taken" required>
            </div>
        </div>
    </div>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary mt-2">Verify</button>
</form>