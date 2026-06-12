<form id="farmer-info-form" action="{{ route('farmer_requests.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="farmer_name">Farmer Name</label>
                <input type="text" class="form-control" id="farmer_id" value="{{ $farmer_information->farmer_id ?? ''  }}"
                    name="farmer_id" hidden>
                    <input type="text" class="form-control" id="farmer_name" value="{{ $farmer_information->farmer_name  ?? '' }}"
                    name="farmer_name" readonly>
            </div>

            <div class="form-group">
                <label for="postal_address">Postal Address</label>
                <input type="text" class="form-control" id="postal_address"
                    value="{{ $farmer_information->postal_address ?? '' }}" name="postal_address" required>
            </div>
            <div class="form-group">
                <label for="province_id">Province</label>
                <input type="text" class="form-control" id="province_id"
                    value="{{ $farmer_information->province->name ?? '' }}" name="province_id">
            </div>

            <div class="form-group">
                <label for="city_id">City</label>
                <input type="text" class="form-control" id="city_id"
                    value="{{ $farmer_information->city->city_name ?? '' }}" name="city_id">
            </div>
            <div class="form-group">
                <label for="country_id">Country</label>
                <input type="text" class="form-control" id="country_id"
                    value="{{ $farmer_information->country->name ?? '' }}" name="country_id">
            </div>


            <div class="form-group">
                <label for="contact_phone">Contact Phone</label>
                <input type="text" class="form-control" id="contact_phone"
                    value="{{ $farmer_information->contact_phone ?? '' }}" name="contact_phone" required>
            </div>
            <div class="form-group">
                <label for="receipt_number">Receipt Number</label>
                <input type="text" class="form-control" id="receipt_number" value="" name="receipt_number">
            </div>
            <div class="form-group">
                <label for="number_of_samples">Number of Samples</label>
                <input type="number" class="form-control" id="number_of_samples" name="number_of_samples">
            </div>
            <div class="form-group">
                <label for="earliest_date_of_collection">Earliest Date of Collection</label>
                <input type="date" class="form-control" id="earliest_date_of_collection" value=""
                    name="earliest_date_of_collection" required>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="farm_name">Farm Name</label>
                <input type="text" class="form-control" id="farm_name" name="farm_name" hidden>
                
                @if(isset($farmer_information->farm) && $farmer_information->farm->count() > 0)
                    <select class="form-control" id="farm_id" name="farm_id" onchange="farm_selected(this.value)" required>
                        <option value=""> Select Farm</option>
                        @foreach ($farmer_information->farm as $farm)
                            <option value="{{ $farm->farm_id }}"> {{ $farm->farm_name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <div class="alert alert-warning p-2">
                        You have no farms registered. 
                        <a href="{{ route('farmer.profile') }}">Click here to add a farm</a> first.
                    </div>
                    <select class="form-control d-none" id="farm_id" name="farm_id" required>
                        <option value="">No farms available</option>
                    </select>
                @endif
            </div>
            <div class="form-group">
                <label for="date_received">Date Received</label>
                <input type="date" class="form-control" id="date_received" value="" name="date_received"
                    required>
            </div>
            <div class="form-group">
                <label for="date_sampled">Date Sampled</label>
                <input type="date" class="form-control" id="date_sampled" value="" name="date_sampled">
            </div>
            <div class="form-group">
                <label for="ica_locality">ICA Locality</label>
                <input type="text" class="form-control" id="ica_locality" name="ica_locality">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"
                    value="{{ $farmer_information->user->email ?? '' }}" name="email">
            </div>
            <div class="form-group">
                <label for="advisor_name">Advisor Name</label>
                <input type="text" class="form-control" id="advisor_name" value="" name="advisor_name">
            </div>
            <div class="form-group">
                <label for="approved">Approved</label>
                <select type="checkbox" class="form-control" id="approved" name="approved">
                    <option value="N"> Not Approved
                    </option>
                    <option value="Y">Approved</option>
                </select>
            </div>
            <div class="form-group">
                <label for="average_sub_samples_taken">Average Sub Samples Taken</label>
                <input type="number" class="form-control" id="average_sub_samples_taken" value=""
                    name="average_sub_samples_taken" required>
            </div>
        </div>
    </div>
    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary mt-2">Verify</button>
</form>


@section('scripts')
    <script>
    
    
        function farm_selected(value) {
        var farmName = get_farm_name(value);
        document.getElementById('farm_name').value = farmName;

    }

    function get_farm_name(id) {
        var farms = <?= json_encode($farmer_information->farm) ?>; // Correctly encode the PHP array to JavaScript
        var farm = farms.find((i) => i.farm_id == id); // Use 'find' to get the first matching object
        return farm ? farm.farm_name : ''; // Return the farm_name if the farm is found, otherwise return an empty string
    }
       
       
    </script>
@endsection
