@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Dashboard')
@section('content')


    <div class="row">
        @if(!(Auth::check() && Auth::user()->role_id == 2 && $farmer_request !== null))
        <div class="col-lg-{{ $farmer_request !== null ? 7 : 12 }} ">
            <div class=" card mb-1 shadow-none border">
                <div class="card-body">
                    <h4>Farmer Information Form</h4>
                    <hr />
                    @if ($farmer_request !== null)
                        @include('request.partials.request.sample_request_form')
                    @elseif($farmer_information !== null)
                        @include('request.partials.request.new_sample_request_form')
                    @else
                        <h3>Error</h3>
                    @endif
                </div>
            </div>
        </div>
        @endif
        @if (Auth::check() && Auth::user()->role_id == 2)
    <div class="col-lg-12">
        <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4>Add Sample Information</h4>
                                    <hr />
                                    <form id="form-wizard" action="{{ route('farmer_requests.add_sample') }}" method="POST">
                                        @csrf
                                        @php $requestId = request()->route('id') ?? ($farmer_request->request_id ?? null); @endphp
                                        <input type="hidden" name="request_id" value="{{ $requestId }}" />

                                        <!-- Step 1: Sample Identification -->
                                        <div class="form-step" id="step-1">
                                            <h5>Sample Identification</h5>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-4">
                                                <div class="form-group">
                                                    <label for="laboratory_number">Laboratory Number</label>
                                                    <input type="text" class="form-control" id="laboratory_number" name="laboratory_number" required>
                                                </div>
                                            </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="long">Sample Reference</label>
                                                        <input type="text" class="form-control" id="sample_reference"
                                                            name="sample_reference" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="plot_id">Plot</label>
                                                        <select type="text" class="form-control" id="plot_id"
                                                            name="plot_id" required>
                                                            <option value="1">Plot 1</option>
                                                            <option value="2">Plot 2</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Step 3: Previous Crop Information -->
                                        <div class="form-step" id="step-2">
                                            <h5>Previous Crop Details</h5>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="type_of_previous_crop">Type of Previous Crop</label>
                                                        <input type="text" class="form-control"
                                                            id="type_of_previous_crop" name="type_of_previous_crop"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="date_of_ploughing">Date of Ploughing</label>
                                                        <input type="date" class="form-control" id="date_of_ploughing"
                                                            name="date_of_ploughing">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="date_planted">Date Planted</label>
                                                        <input type="date" class="form-control" id="date_planted"
                                                            name="date_planted">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="previous_crop_yield">Previous Crop Yield (kg per
                                                            hectare)</label>
                                                        <input type="number" step="0.01"class="form-control"
                                                            id="previous_crop_yield" name="previous_crop_yield">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Step 4: Crop Information -->
                                        <div class="form-step" id="step-3">
                                            <h5>Intended Crop Details</h5>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="crop">Current Crop</label>
                                                        <input type="text" class="form-control" id="crop"
                                                            name="crop" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="crop_to_be_irrigated">Irrigation</label>
                                                        <select class="form-control"
                                                            id="crop_to_be_irrigated" name="crop_to_be_irrigated" required>
                                                            <option value="N" selected>No</option>
                                                            <option value="Y">Yes</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="planting_date">Planting Date</label>
                                                        <input type="date" class="form-control" id="planting_date"
                                                            name="planting_date">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="plant_pop_per_ha">Plant Population per Hectare</label>
                                                        <input type="number" step="0.01"class="form-control"
                                                            id="plant_pop_per_ha" name="plant_pop_per_ha">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="yield_target_kg_per_ha">Yield Target (kg per
                                                            hectare)</label>
                                                        <input type="number" step="0.01"class="form-control"
                                                            id="yield_target_kg_per_ha" name="yield_target_kg_per_ha">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="land_size">Land Size</label>
                                                        <input type="number" step="0.01"class="form-control"
                                                            id="land_size" name="land_size" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="manure_to_be_used">Manure to be Used</label>

                                                        <select type="text" class="form-control"
                                                            id="manure_to_be_used" name="manure_to_be_used" required>
                                                            <option value="N" selected>No</option>
                                                            <option value="Y">Yes</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fertilizer_to_be_used">Fertilizer to be Used</label>

                                                        <select type="text" class="form-control"
                                                            id="fertilizer_to_be_used" name="fertilizer_to_be_used"
                                                            required>
                                                            <option value="N" selected>No</option>
                                                            <option value="Y">Yes</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Step 2: Location Information -->
                                        <div class="form-step" id="step-4">
                                            <h5>Plot Coordinates</h5>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="lat">Latitude</label>
                                                        <input type="text" class="form-control" id="lat"
                                                            name="lat" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="long">Longitude</label>
                                                        <input type="text" class="form-control" id="long"
                                                            name="long" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons mt-3">
                                            <button type="button" class="btn btn-secondary" id="prev-btn"
                                                disabled>Previous</button>
                                            <button type="button" class="btn btn-primary" id="next-btn">Next</button>
                                            <button type="submit" class="btn btn-success" id="submit-btn"
                                                style="display: none;">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

    </div>
    @if (!empty($soil_samples) && $soil_samples->count() > 0)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <h4>Recorded Samples</h4>
                    <hr />
                    <table
                        class="table table-centered w-100 dt-responsive nowrap dataTable no-footer dtr-inline collapsed">
                        <thead>
                            <thead>
                                <tr>
                                    <th>Laboratory Number</th>
                                    <th>Sample Reference</th>
                                    <th>Type of Previous Crop</th>
                                    <th>Current Crop</th>
                                    <th>Irrigation</th>
                                    <th>Land Size</th>
                                    <th>Manure</th>
                                    <th>Fertilizer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        <tbody class="sample-body">
                            @if (isset($soil_samples))
                                @foreach ($soil_samples as $sample)
                                    <tr>
                                        <td>{{ $sample->laboratory_number ?? '' }}</td>
                                        <td>{{ $sample->sample_reference ?? '' }}</td>
                                        <td>{{ $sample->type_of_previous_crop ?? '' }}</td>

                                        <td>{{ $sample->crop ?? '' }}</td>
                                        <td>{{ $sample->crop_to_be_irrigated ?? '' }}</td>

                                        <td>{{ $sample->land_size ?? '' }}</td>
                                        <td>{{ $sample->manure_to_be_used ?? '' }}</td>
                                        <td>{{ $sample->fertilizer_to_be_used ?? '' }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">Options</button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('soil_sample_results.create', $sample->sample_id) }}">Analysis
                                                    Results
                                                </a>
                                                <a class="dropdown-item"
                                                    href="{{ route('recommendation.create', $farmer_request->request_id ?? '') }}">Recommenation
                                                    Results</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('farmer_requests.edit', $farmer_request->request_id ?? '') }}">Edit Request</a>
                                                <form action="{{ route('farmer_requests.delete_sample', $sample->sample_id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this sample?');">Delete Sample</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('request.partials.results.soil_results_recommendation')


    @endif



@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('assets/js/ui/component.fileupload.js') }}"></script>

    <script>
        $(function() {
            var form = $('#form-wizard');
            var currentTab = 0;
            var totalTabs = form.find('.form-step').length;

            $('#next-btn').click(function() {
                var valid = validateForm();

                if (valid) {
                    currentTab++;
                    showTab(currentTab);
                }
            });

            $('#prev-btn').click(function() {
                currentTab--;
                showTab(currentTab);
            });

            function validateForm() {
                var valid = true;
                var currentStep = form.find('.form-step').eq(currentTab);
                var inputs = currentStep.find(':input[required]:visible');

                inputs.each(function() {
                    if (!this.validity.valid) {
                        valid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                return valid;
            }

            function showTab(index) {
                var steps = form.find('.form-step');
                var nextBtn = $('#next-btn');
                var prevBtn = $('#prev-btn');
                var submitBtn = $('#submit-btn');

                steps.hide().eq(index).show();

                if (index === 0) {
                    prevBtn.prop('disabled', true);
                } else {
                    prevBtn.prop('disabled', false);
                }

                if (index === totalTabs - 1) {
                    nextBtn.hide();
                    submitBtn.show();
                } else {
                    nextBtn.show();
                    submitBtn.hide();
                }
            }

            showTab(currentTab);
        });
    </script>
@endsection
