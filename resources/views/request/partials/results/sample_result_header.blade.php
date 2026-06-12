


    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h5><b>Farmer Name:</b> {{$farmer_sample_information->farmerRequest->farmer->farmer_name ?? ''}}</h5>

                </div>
                <div class="">
                    <h5>Phone Number: {{$farmer_sample_information->farmerRequest->farmer->contact_phone ?? ''}}</h5>
                </div>
                <div class="">
                    <h5>Farm Name: {{ $farmer_sample_information->farmerRequest->farm->farm_name ?? '' }}</h5>
                </div>
                <div class="">
                    <h5>Date Sampled: {{ $farmer_sample_information->farmerRequest->date_sampled ?? ''}}</h5>
                </div>

            </div>
            <div class="col-lg-12">
              
                <div class="">
                    <h5>Date Received:{{ $farmer_sample_information->farmerRequest->date_received ?? ''}}</h5>
                </div>
                <div class="">
                    <h5>Laboratory Number:{{ $farmer_sample_information->laboratory_number ?? ''}}</h5>
                </div>
                <div class="">
                    <h5>Sample Reference:{{ $farmer_sample_information->sample_reference ?? ''}}</h5>
                </div>
            </div>
            
        </div>
    </div>
   
