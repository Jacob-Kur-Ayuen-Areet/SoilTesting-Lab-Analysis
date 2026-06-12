<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                {{-- @dd($farmer_sample_information) --}}
                @if (isset($farmer_sample_information->farmerRequest->farmerSampleRecRequest))
                    <div class="row">
                        <div class="col-lg-6">
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
                                            <a href="{{ route('soil_sample_results.generatePdf', $farmer_sample_information->request_id ?? '') }}" class="text-muted fw-bold">Download The Samples and Soil Analysis Result
                                                Sheet</a>
                                            {{-- <p class="mb-0">2.3 MB</p> --}}
                                        </div>
                                        
                                        <div class="col-auto">
                                            <!-- Button -->
                                            <a href="{{ route('soil_sample_results.generatePdf', $farmer_sample_information->request_id ?? '') }}" class="btn btn-link btn-lg text-muted">
                                                <i class="ri-download-2-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (isset($farmer_sample_information->farmerRequest->farmerSampleRecRequest))
                                 
                                
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
                                                <a href="{{ route('recommendation.download', $farmer_sample_information->farmerRequest->farmerSampleRecRequest->reco_id) }}"
                                                    class="text-muted fw-bold" data-dz-name>Recommenation Doc</a>
                                                <p class="mb-0" data-dz-size></p>
                                            </div>
                                            <div class="col-auto">
                                                <!-- Button -->
                                                <a href="{{ route('recommendation.download', $farmer_sample_information->farmerRequest->farmerSampleRecRequest->reco_id) }}"
                                                    class="btn btn-link btn-lg text-muted">
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

                        </div> <!-- end col-->

                        <div class="col-lg-6">

                            <div class="mb-3 mt-3 mt-xl-0">
                                <label for="sample_recommendation" class="mb-0">Upload Recommenation</label>
                                <p class="text-muted font-14">Recommended pdf file.</p>

                                <form action="{{ route('recommendation.upload') }}" method="post" class="dropzone"
                                    id="myAwesomeDropzone" data-plugin="dropzone"
                                    data-previews-container="#file-previews"
                                    data-upload-preview-template="#uploadPreviewTemplate">
                                    @csrf
                                    <input type="text" class="form-control" id="new_request_id"
                                        value="{{ $farmer_sample_information->request_id ?? '' }}" name="request_id"
                                        hidden>
                                    <input type="text" class="form-control" id="new_sample_id"
                                        value="{{ $farmer_sample_information->sample_id ?? '' }}" name="sample_id"
                                        hidden>

                                    <div class="fallback">
                                        <input name="file" type="file" id="file" />
                                    </div>


                                    <div class="dz-message needsclick">
                                        <i class="h3 text-muted ri-upload-cloud-2-line"></i>
                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </form>

                                <!-- Preview -->
                                <div class="dropzone-previews mt-3" id="file-previews"></div>

                                <!-- file preview template -->
                                <div class="d-none" id="uploadPreviewTemplate">
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
                                                    <a href="javascript:void(0);" class="text-muted fw-bold"
                                                        data-dz-name></a>
                                                    <p class="mb-0" data-dz-size></p>
                                                </div>
                                                <div class="col-auto">
                                                    <!-- Button -->
                                                    <a href="#" class="btn btn-link btn-lg text-muted"
                                                        data-dz-remove>
                                                        <i class="ri-close-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <form id="form-wizard" action="{{ route('recommendation.update') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="request_id"
                                        value="{{ $farmer_sample_information->request_id ?? '' }}" name="request_id"
                                        hidden>
                                    <input type="text" class="form-control" id="new_sample_id"
                                        value="{{ $farmer_sample_information->sample_id ?? '' }}" name="sample_id"
                                        hidden>
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Comment</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="2"
                                            placeholder="Enter some brief comments..">{{ $farmer_sample_information->farmerRequest->farmerSampleRecRequest != null ?? $farmer_sample_information->farmerRequest->farmerSampleRecRequest->notes ? $farmer_sample_information->farmerRequest->farmerSampleRecRequest->notes : '' }}</textarea>
                                    </div>
                                    <label for="approved" class="form-label">Approve</label>

                                    <select class="form-control " id="approved" name="approved">
                                        <option value="N"
                                            {{ $farmer_sample_information->farmerRequest->farmerSampleRecRequest != null ?? $farmer_sample_information->farmerRequest->farmerSampleRecRequest->approved == 'N' ? 'selected' : '' }}>
                                            No</option>
                                        <option value="Y"
                                            {{ $farmer_sample_information->farmerRequest->farmerSampleRecRequest != null ?? $farmer_sample_information->farmerRequest->farmerSampleRecRequest->approved == 'Y' ? 'selected' : '' }}>
                                            Yes</option>

                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                                </form>
                                <!-- end file preview template -->
                            </div>

                            <!-- Date View -->
                            </form>
                        </div> <!-- end col-->
                    </div>
                @else
                    <h3>Request Not Found !!</h3>
                @endif
                <!-- end row -->

            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col-->
</div>
