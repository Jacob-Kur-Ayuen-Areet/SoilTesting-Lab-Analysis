@extends('layouts.master')
@section('page_title', 'Dashboard')
@section('content')
<?php
$textureOptions = [
    'S' => 'Sandy',
    'LS' => 'Loam Sand',
    'L' => 'Loam',
    'CL' => 'Clay Loam',
    'C' => 'Clay',
    'HC' => 'Heavy Clay',
    'Cg' => 'Course Grained',
    'V' => 'Very',
    'SL' => 'Sandy Loam',
    'SCL' => 'Sandy Clay Loam',
    'SC' => 'Sandy Clay',
    'ZCL' => 'Silty Clay Loam',
    'ZC' => 'Silty Clay',
    'Fg' => 'Fine Grained',
    'Mg' => 'Medium Grained',
];
?>


    <!-- end page title -->
    @if (isset($farmer_sample_information->request_id) && isset($farmer_sample_information->sample_id))
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    @include('request.partials.results.sample_result_header')
                </div>
            </div>
            @if(Auth::user()->role_id !== 2)
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        {{-- @dd($farmer_sample_information) --}}
                        <form id="form-wizard"
                            action="{{ route('soil_sample_results.store', $farmer_sample_information->sample_id) }}"
                            method="POST">
                            @csrf
                            <input type="text" class="form-control" id="request_id"
                                value="{{ $farmer_sample_information->request_id }}" name="request_id" hidden>

                            <input type="text" class="form-control" id="sample_id"
                                value="{{ $farmer_sample_information->sample_id }}" name="sample_id" hidden>

                            <input type="text" class="form-control" id="laboratory_number"
                                value="{{ $farmer_sample_information->laboratory_number }}" name="laboratory_number" hidden>

                    
                            <!-- Step 3 -->
                            <div class="form-step" id="step-3">
                                <h5>Soil Analysis</h5>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="ph_cacl2">pH (CaCl2)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->ph_cacl2 ?? ''}}" name="ph_cacl2">
                                        </div>
                                        <div class="form-group">
                                            <label for="colour">Colour</label>
                                            <input type="text" class="form-control" value="{{$farmer_sample_information->soilSampleResult->colour ?? ''}}" name="colour">
                                        </div>
                                        <div class="form-group">
                                            <label for="texture">Texture</label>
                                            <select class="form-control"  name="texture">
                                                <option value="">Select Texture</option>
                                                @foreach ($textureOptions as $value => $label)
                                                <option value="{{$value}}" {{isset($farmer_sample_information->soilSampleResult) ? $farmer_sample_information->soilSampleResult->texture == $value ? 'selected' : '' : ''}}>{{$label}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="percentage_sand">Percentage Sand</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->percentage_sand ?? ''}}" name="percentage_sand">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-group">
                                            <label for="percentage_silt">Percentage Silt</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->percentage_silt ??  ''}}" name="percentage_silt">
                                        </div>
                                        <div class="form-group">
                                            <label for="percentage_clay">Percentage Clay</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->percentage_clay ?? ''}}" name="percentage_clay">
                                        </div>
                                        <div class="form-group">
                                            <label for="min_initial_n">Minimum Initial N</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->min_initial_n ?? ''}}" name="min_initial_n">
                                        </div>
                                        <div class="form-group">
                                            <label for="p2o5_ppm">P2O5 (ppm)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->p2o5_ppm ?? ''}} " name="p2o5_ppm">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="form-step" id="step-4">
                                <h5>MELICH 3 EXTRACTION</h5>
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <h6>Exchange Cations (meq. %)</h6>
                                        <div class="form-group">
                                            <label for="k">Potassium (K)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->k ?? ''}}" name="k">
                                        </div>
                                        <div class="form-group">
                                            <label for="mg">Magnesium (Mg)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->mg ?? ''}}" name="mg">
                                        </div>
                                        <div class="form-group">
                                            <label for="ca">Calcium (Ca)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->ca ?? ''}}" name="ca">
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-6">
                                        <h6>Micronutrients (ppm)</h6>
                                        <div class="form-group">
                                            <label for="zn">Zinc (Zn)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->zn ?? ''}}" name="zn">
                                        </div>
                                        <div class="form-group">
                                            <label for="cu">Copper (Cu)</label>
                                            <input type="number" step="0.001" class="form-control" value="{{$farmer_sample_information->soilSampleResult->cu ?? ''}}" name="cu">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Add more steps if needed -->

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
            @endif
        </div>
        @include('request.partials.results.sample_result_table')
        @include('request.partials.results.soil_results_recommendation')
    @else
        <div class="card">
            <div class="card-body">
                <h3>Request Not Found !!</h3>
            </div>
        </div>
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
