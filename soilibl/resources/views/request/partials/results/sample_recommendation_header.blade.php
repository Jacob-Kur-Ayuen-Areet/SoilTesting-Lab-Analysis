<div class="">
    <h4><b>Farmer Name:</b> {{ $farmer_sample_information->farmer->farmer_name ?? "not available" }}</h4>

</div>
<div class="">
    <h4>Farm Name: {{ $farmer_sample_information->farm->farm_name ??  "not available"  }}</h4>
</div>
<div class="">
    <h4>Date Sampled: {{ $farmer_sample_information->date_sampled ?? "not available"  }}</h4>
</div>
<div class="">
    <h4>Date Received:{{ $farmer_sample_information->date_received ?? "not available" }}</h4>
</div>
<div class="">
    <h4>Number of Samples Collected:{{ $farmer_sample_information->number_of_samples ?? "not available" }}</h4>
</div>
<div class="">
    <h4>Average Sub Samples Taken:{{ $farmer_sample_information->sample_reference ?? "not available" }}</h4>
</div>
<div class="card mt-1 mb-0 shadow-none border">
    <div class="p-2">
        <div class="row align-items-center">
            <div class="col-auto">
                <div class="avatar-sm">
                    <span class="avatar-title rounded">
                        .PDF
                    </span>
                </div>
            </div>
            <div class="col ps-0">
                <a href="javascript:void(0);" class="text-muted fw-bold">Download The Samples and Soil Analysis Result
                    Sheet</a>
                {{-- <p class="mb-0">2.3 MB</p> --}}
            </div>
            <div class="col-auto">
                <!-- Button -->
                <a href="javascript:void(0);" class="btn btn-link btn-lg text-muted">
                    <i class="ri-download-2-line"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@if (isset($farmer_sample_information->farmerSampleRecRequest))
    <div class="card mt-1 mb-0 shadow-none border">
        <div class="p-2">
            <div class="row align-items-center">
                <div class="col-auto">
                    <div class="avatar-sm">
                        <span class="avatar-title rounded">
                            .PDF
                        </span>
                    </div>
                </div>
                <div class="col ps-0">
                    <a href="{{route('recommendation.download',$farmer_sample_information->farmerSampleRecRequest->reco_id)}}" class="text-muted fw-bold" data-dz-name>Recommenation Doc</a>
                    <p class="mb-0" data-dz-size></p>
                </div>
                <div class="col-auto">
                    <!-- Button -->
                    <a href="{{route('recommendation.download',$farmer_sample_information->farmerSampleRecRequest->reco_id)}}" class="btn btn-link btn-lg text-muted">
                        <i class="ri-download-2-line"></i>
                    </a>
                </div>
                <div class="col-auto">
                    <!-- Button -->
                    <a href="#" class="btn btn-link btn-lg text-muted" data-dz-remove>
                        <i class="ri-close-line"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
