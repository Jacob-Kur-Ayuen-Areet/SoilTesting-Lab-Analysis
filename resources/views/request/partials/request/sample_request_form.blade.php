

<form id="farmer-info-form" action="{{ route('farmer_requests.update',$farmer_request->request_id ?? '') }}" method="POST">
    @csrf

        <div class="row">
            <div class="col-lg-6">
                <div class="">
                    <h5><b>Name:</b> {{$farmer_request->farmer->farmer_name ?? ''}}</h5>

                </div>
                <div class="">
                    <h5>Phone: {{$farmer_request->farmer->contact_phone ?? ''}}</h5>
                </div>
                <div class="">
                    <h5>Name: {{ $farmer_request->farm->farm_name ?? ''}}</h5>
                </div>

                <div class="">
                    <h5>Date Sampled: {{ $farmer_request->date_sampled ?? ''}}</h5>
                </div>
                <div class="">
                    <h5>Number of Samples:{{ $farmer_request->number_of_samples ?? '' }}</h5>
                </div>
                <div class="">
                    <h5>Average Sub Samples Taken:{{ $farmer_request->average_sub_samples_taken ?? ''}}</h5>
                </div>
            </div>
            <div class="col-lg-6">
                <input type="date" class="form-control" id="request_id"
                value="{{ $farmer_request->request_id ?? '' }}" name="request_id" hidden>
                <div class="form-group">
                    <label for="date_received" class="col-6">Date Received</label>
                    <input type="date" class="form-control" id="date_received"
                        value="{{ $farmer_request->date_received ?? '' }}" name="date_received" {{Auth::user()->role_id == 2 ? 'readonly' : '' }} required>
                </div>
                <div class="form-group">
                    <label for="receipt_number" class="col-6">Receipt Number</label>
                    <input type="text" class="form-control" id="advisor_name"
                        value="{{ $farmer_request->receipt_number ?? '' }}" name="receipt_number" {{Auth::user()->role_id == 2 ? 'readonly' : '' }}>
                </div>
                <div class="form-group">
                    <label for="advisor_name" class="col-6">Advisor Name</label>
                    <input type="text" class="form-control" id="advisor_name"
                        value="{{ $farmer_request->advisor_name ?? '' }}" name="advisor_name" {{Auth::user()->role_id == 2 ? 'readonly' : '' }}>
                </div>
                <div class="form-group">
                    <label for="approved" class="col-6">QC Approved</label>
                    <select type="checkbox" class="form-control" id="approved" name="approved" {{Auth::user()->role_id == 2 ? 'disabled' : '' }}>
                        <option value="N" {{ $farmer_request->approved  !== null ? $farmer_request->approved == 'N' ? 'selected': '' :''}}> Not Approved
                        </option>
                        <option value="Y" {{ $farmer_request->approved !==  null ? $farmer_request->approved == 'Y' ? 'selected': '' :''}}>Approved</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2" {{Auth::user()->role_id == 2 ? 'disabled' : '' }}>Update</button>
            </div>
        </div>
   
   
    <!-- Submit Button -->
  
</form>