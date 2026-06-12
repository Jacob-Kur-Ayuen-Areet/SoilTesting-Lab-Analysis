@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Dashboard')
@section('content')
    <style>
        .form-step {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* .form-heading {
                        padding-bottom: 10px;
                        border-bottom: 1px solid #dee2e6;
                        margin-bottom: 20px;
                    } */

        .form-group {
            margin-bottom: 15px;
        }

        #validation-message {
            margin-bottom: 20px;
        }
    </style>
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


    @if($farmer_sample_information->soilSampleResult && $farmer_sample_information->soilSampleResult->approved == 'Y')
    <div class="mt-3">
        <a href="{{ route('soil_sample_results.generatePdf', ['id' => $farmer_sample_information->request_id ?? 0]) }}" class="btn btn-primary">Download Analysis PDF</a>
    </div>
@endif
@if($farmer_sample_information->farmerRequest && $farmer_sample_information->farmerRequest->farmerSampleRecRequest && $farmer_sample_information->farmerRequest->farmerSampleRecRequest->approved == 'Y')
    <div class="mt-3">
        <a href="{{ route('recommendation.download', $farmer_sample_information->farmerRequest->farmerSampleRecRequest->reco_id) }}" class="btn btn-success">Download Recommendation</a>
    </div>
@endif
    @if (isset($farmer_sample_information->request_id) && isset($farmer_sample_information->sample_id))

        @if(Auth::check() && Auth::user()->role_id == 1)
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    @include('request.partials.results.sample_result_header')
                </div>
            </div>
            @if (Auth::user()->role_id !== 2)
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
                                    value="{{ $farmer_sample_information->laboratory_number }}" name="laboratory_number"
                                    hidden>



                                <div class="form-step" id="step-3">
                                    <div class="form-heading">
                                        <h5>Soil Analysis</h5>
                                    </div>
                                    <div id="validation-message" style="color: red; display: none;"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{-- </div>
                                        <div class="col-md-6"> --}}
                                            <div id="texturemethod" class="">
                                                <div class="form-group">
                                                    <label for="texturemethod">Texture Analysis Method</label>
                                                    <select class="form-control" name="texturemethod">
                                                        <option value="">Select Method</option>
                                                        <option value="hand_feel"
                                                            {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->texturemethod == 'hand_feel' ? 'selected' : '') : '' }}>
                                                            Texture Hand Feel</option>
                                                        <option value="hydrometer"
                                                            {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->texturemethod == 'hydrometer' ? 'selected' : '') : '' }}>
                                                            Texture by Hydrometer</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="texture">Texture</label>
                                                    <select class="form-control" name="texture">
                                                        <option value="">Select Texture</option>
                                                        @foreach ($textureOptions as $value => $label)
                                                            <option value="{{ $value }}"
                                                                {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->texture == $value ? 'selected' : '') : '' }}>
                                                                {{ $label }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="percentage_sand">Percentage Sand</label>
                                                    <input type="number" step="0.001" class="form-control"
                                                        value="{{ $farmer_sample_information->soilSampleResult->percentage_sand ?? '' }}"
                                                        name="percentage_sand">
                                                </div>
                                                <div class="form-group">
                                                    <label for="percentage_silt">Percentage Silt</label>
                                                    <input type="number" step="0.001" class="form-control"
                                                        value="{{ $farmer_sample_information->soilSampleResult->percentage_silt ?? '' }}"
                                                        name="percentage_silt">
                                                </div>
                                                <div class="form-group">
                                                    <label for="percentage_clay">Percentage Clay</label>
                                                    <input type="number" step="0.001" class="form-control"
                                                        value="{{ $farmer_sample_information->soilSampleResult->percentage_clay ?? '' }}"
                                                        name="percentage_clay">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phmethod">pH Method</label>
                                                <select class="form-control" name="phmethod">
                                                    <option value="0.01M CaCl2"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->phmethod == '0.01M CaCl2' ? 'selected' : '') : '' }}>
                                                        0.01M CaCl2</option>
                                                    <option value="1M KCl"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->phmethod == '1M KCl' ? 'selected' : '') : '' }}>
                                                        1M KCl</option>
                                                </select>
                                                <label for="ph_cacl2_dilution">Dilution Ratio</label>
                                                <select class="form-control" name="dilutionratio">
                                                    <option value="1:1"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->dilutionratio == '1:1' ? 'selected' : '') : '' }}>
                                                        1:1</option>
                                                    <option value="1:2.5"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->dilutionratio == '1:2.5' ? 'selected' : '') : '' }}>
                                                        1:2.5</option>
                                                    <option value="1:5"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->dilutionratio == '1:5' ? 'selected' : '') : '' }}>
                                                        1:5</option>
                                                </select>
                                                <label for="ph_cacl2">pH value</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->ph_cacl2 ?? '' }}"
                                                    name="ph_cacl2">
                                            </div>
                                            <div class="form-group">
                                                <label for="colour">Colour</label>
                                                <input type="text" class="form-control" name="colour"
                                                    value="{{ $farmer_sample_information->soilSampleResult->colour ?? '' }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="min_initial_n">Minimum Initial N</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->min_initial_n ?? '' }}"
                                                    name="min_initial_n">
                                            </div>
                                            <div id="phosphorousmethods" class="">
                                                <div class="form-group">
                                                    <label for="phosphorousmethods">Phosphorous Analysis Method</label>
                                                    <select class="form-control" name="phosphorousmethods">
                                                        <option value="">Select Method</option>
                                                        <option value="melhich_iii"
                                                            {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->phosphorousmethods == 'melhich_iii' ? 'selected' : '') : '' }}>
                                                            Melhich III</option>
                                                        <option value="olsen"
                                                            {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->phosphorousmethods == 'olsen' ? 'selected' : '') : '' }}>
                                                            Olsen Method</option>
                                                        <option value="resin"
                                                            {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->phosphorousmethods == 'resin' ? 'selected' : '') : '' }}>
                                                            Resin Method</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="p2o5_ppm">P2O5 (ppm)</label>
                                                    <input type="number" step="0.001" class="form-control"
                                                        value="{{ $farmer_sample_information->soilSampleResult->p2o5_ppm ?? '' }}"
                                                        name="p2o5_ppm">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4 -->
                                <div class="form-step" id="step-4" style="display: none;">
                                    <div class="form-heading">
                                        <h5>MELICH 3 EXTRACTION</h5>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6" id="exchangeablemethods">
                                            <h6>Exchange Cations (meq. %)</h6>
                                            <div class="form-group">
                                                <label for="exchangeablemethods">Exchangeable Cations Method</label>
                                                <select class="form-control" name="exchangeablemethods">
                                                    <option value="">Select Method</option>
                                                    <option value="mehlich_iii"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->exchangeablemethods == 'mehlich_iii' ? 'selected' : '') : '' }}>
                                                        Mehlich III Method</option>
                                                    <option value="ammonium_acetate"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->exchangeablemethods == 'ammonium_acetate' ? 'selected' : '') : '' }}>
                                                        1M Ammonium Acetate Method</option>
                                                    <option value="others"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->exchangeablemethods == 'others' ? 'selected' : '') : '' }}>
                                                        Others</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="k">Potassium (K)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->k ?? '' }}"
                                                    name="k">
                                            </div>
                                            <div class="form-group">
                                                <label for="mg">Magnesium (Mg)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->mg ?? '' }}"
                                                    name="mg">
                                            </div>
                                            <div class="form-group">
                                                <label for="ca">Calcium (Ca)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->ca ?? '' }}"
                                                    name="ca">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="micronutrientsmethods">
                                            <h6>Micronutrients (ppm)</h6>
                                            <div class="form-group">
                                                <label for="micronutrientsmethods">Micronutrients Analysis Method</label>
                                                <select class="form-control" name="micronutrientsmethods">
                                                    <option value="">Select Method</option>
                                                    <option value="mehlich_iii"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->micronutrientsmethods == 'mehlich_iii' ? 'selected' : '') : '' }}>
                                                        Mehlich III</option>
                                                    <option value="dtpa"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->micronutrientsmethods == 'dtpa' ? 'selected' : '') : '' }}>
                                                        DTPA</option>
                                                    <option value="edta"
                                                        {{ isset($farmer_sample_information->soilSampleResult) ? ($farmer_sample_information->soilSampleResult->micronutrientsmethods == 'edta' ? 'selected' : '') : '' }}>
                                                        EDTA</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="zn">Zinc (Zn)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->zn ?? '' }}"
                                                    name="zn">
                                            </div>
                                            <div class="form-group">
                                                <label for="cu">Copper (Cu)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->cu ?? '' }}"
                                                    name="cu">
                                            </div>
                                            <div class="form-group">
                                                <label for="mn">Manganese (Mn)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->mn ?? '' }}"
                                                    name="mn">
                                            </div>
                                            <div class="form-group">
                                                <label for="fe">Iron (Fe)</label>
                                                <input type="number" step="0.001" class="form-control"
                                                    value="{{ $farmer_sample_information->soilSampleResult->fe ?? '' }}"
                                                    name="fe">
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
                            @if($farmer_sample_information->soilSampleResult && $farmer_sample_information->soilSampleResult->approved == 'Y')
                                <div class="mt-3">
                                    <a href="{{ route('soil_sample_results.generatePdf', ['id' => $farmer_sample_information->request_id ?? 0]) }}" class="btn btn-primary">Download Analysis PDF</a>
                                </div>
                            @endif
                            @if($farmer_sample_information->farmerSampleRecRequest && $farmer_sample_information->farmerSampleRecRequest->approved == 'Y')
                                <div class="mt-3">
                                    <a href="{{ route('recommendation.download', $farmer_sample_information->farmerSampleRecRequest->reco_id) }}" class="btn btn-success">Download Recommendation</a>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>

            {{-- ═══ AI ANALYSIS PANEL (admin only) ══════════════════════════════════ --}}
            @php $ssr = $farmer_sample_information->soilSampleResult; @endphp
            @if($ssr)
            <div class="col-md-12 mt-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="header-title mb-0">
                                <i class="mdi mdi-robot-outline me-1 text-primary"></i>
                                AI Soil Analysis Interpretation
                            </h5>
                            @php
                                $aiStatus = $ssr->ai_analysis_status ?? 'none';
                            @endphp
                            <span id="ai-status-badge" class="badge fs-6
                                {{ $aiStatus === 'approved'   ? 'bg-success' :
                                   ($aiStatus === 'pending'    ? 'bg-warning text-dark' :
                                   ($aiStatus === 'rejected'   ? 'bg-danger' :
                                   ($aiStatus === 'processing' ? 'bg-info text-white' :
                                   ($aiStatus === 'failed'     ? 'bg-danger' : 'bg-secondary')))) }}">
                                @if($aiStatus === 'processing') ⏳ Generating…
                                @elseif($aiStatus === 'failed') ❌ Failed — Please Retry
                                @elseif($aiStatus === 'none') Not Generated
                                @else {{ ucfirst($aiStatus) }}
                                @endif
                            </span>
                        </div>

                        {{-- AI textarea (editable for admin) --}}
                        <textarea id="ai-analysis-text" class="form-control mb-3" rows="8"
                            placeholder="Click 'Generate AI Analysis' to automatically interpret the soil lab results..."
                            style="font-size:0.92rem; line-height:1.6;">{{ $ssr->ai_analysis ?? '' }}</textarea>

                        {{-- Action buttons --}}
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" id="btn-ai-generate"
                                class="btn btn-primary"
                                data-result-id="{{ $ssr->result_id }}"
                                data-url="{{ route('soil_sample_results.ai.analyze', $ssr->result_id) }}"
                                data-status-url="{{ route('soil_sample_results.ai.status', $ssr->result_id) }}"
                                {{ in_array($aiStatus, ['processing']) ? 'disabled' : '' }}>
                                <i class="mdi mdi-robot me-1"></i>
                                <span id="btn-ai-generate-text">
                                    {{ $aiStatus === 'processing' ? '⏳ Generating…' : ($aiStatus === 'failed' ? 'Retry AI Analysis' : 'Generate AI Analysis') }}
                                </span>
                            </button>

                            @if(in_array($aiStatus, ['pending', 'approved', 'rejected', 'failed']))
                            @if(in_array($aiStatus, ['pending', 'approved', 'rejected']))
                            <button type="button" id="btn-ai-approve"
                                class="btn btn-success"
                                data-url="{{ route('soil_sample_results.ai.approve', $ssr->result_id) }}">
                                <i class="mdi mdi-check-circle me-1"></i> Approve & Publish
                            </button>
                            @endif
                            <button type="button" id="btn-ai-reject"
                                class="btn btn-outline-danger"
                                data-url="{{ route('soil_sample_results.ai.reject', $ssr->result_id) }}">
                                <i class="mdi mdi-close-circle me-1"></i> Reject
                            </button>
                            @endif
                        </div>

                        @if($aiStatus === 'approved')
                        <div class="alert alert-success mt-3 mb-0 py-2">
                            <i class="mdi mdi-check me-1"></i>
                            This AI interpretation is <strong>approved</strong> and visible to the farmer.
                        </div>
                        @elseif($aiStatus === 'pending')
                        <div class="alert alert-warning mt-3 mb-0 py-2">
                            <i class="mdi mdi-eye-off me-1"></i>
                            <strong>Pending review</strong> — hidden from farmer until approved.
                        </div>
                        @elseif($aiStatus === 'processing')
                        <div class="alert alert-info mt-3 mb-0 py-2">
                            <i class="mdi mdi-loading mdi-spin me-1"></i>
                            <strong>Generating…</strong> The AI is working on the interpretation. This page will refresh automatically.
                        </div>
                        @elseif($aiStatus === 'failed')
                        <div class="alert alert-danger mt-3 mb-0 py-2">
                            <i class="mdi mdi-alert-circle-outline me-1"></i>
                            <strong>Generation failed</strong> — the Gemini API was busy. Please click <em>Retry AI Analysis</em>.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endif

        </div>
        @endif
        
        @include('request.partials.results.sample_result_table')
    @else
        <div class="card">
            <div class="card-body">
                <h3>Request Not Found !!</h3>
            </div>
        </div>
    @endif
@endsection

@section('scripts')


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

        document.addEventListener("DOMContentLoaded", function() {
            const nextBtn = document.getElementById("next-btn");
            const sandInput = document.querySelector("[name='percentage_sand']");
            const siltInput = document.querySelector("[name='percentage_silt']");
            const clayInput = document.querySelector("[name='percentage_clay']");
            const validationMessage = document.getElementById("validation-message");

            function updateButtonState() {
                const sand = parseFloat(sandInput.value) || 0;
                const silt = parseFloat(siltInput.value) || 0;
                const clay = parseFloat(clayInput.value) || 0;
                const total = sand + silt + clay;

                // Check if the total is exactly 100
                if (total !== 100) {
                    validationMessage.style.display = 'block';
                    validationMessage.textContent =
                        "The sum of sand, silt, and clay percentages must equal 100%. Current total: " + total +
                        "%";
                    nextBtn.disabled = true; // Disable the next button
                } else {
                    validationMessage.style.display = 'none'; // Hide the message
                    validationMessage.textContent = '';
                    nextBtn.disabled = false; // Enable the next button
                }
            }

            // Add event listeners to input fields to check validation in real-time
            sandInput.addEventListener('input', updateButtonState);
            siltInput.addEventListener('input', updateButtonState);
            clayInput.addEventListener('input', updateButtonState);

            // Initial check in case values are pre-filled
            updateButtonState();
        });
    </script>

    {{-- ─── AI Analysis AJAX ─────────────────────────────────────────── --}}
    <script>
    (function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
        let pollInterval = null;

        function aiPost(url, body) {
            return fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify(body),
            }).then(r => r.json());
        }

        function aiGet(url) {
            return fetch(url, {
                method: 'GET',
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken },
            }).then(r => r.json());
        }

        function setBadge(status) {
            const badge = document.getElementById('ai-status-badge');
            if (!badge) return;
            const map = {
                approved:   'bg-success',
                pending:    'bg-warning text-dark',
                rejected:   'bg-danger',
                processing: 'bg-info text-white',
                failed:     'bg-danger',
                none:       'bg-secondary',
            };
            badge.className = 'badge fs-6 ' + (map[status] || 'bg-secondary');
            const labels = { processing: '⏳ Generating…', failed: '❌ Failed', none: 'Not Generated' };
            badge.textContent = labels[status] ?? (status.charAt(0).toUpperCase() + status.slice(1));
        }

        function stopPolling() {
            if (pollInterval) { clearInterval(pollInterval); pollInterval = null; }
        }

        function startPolling(statusUrl) {
            stopPolling();
            pollInterval = setInterval(function() {
                aiGet(statusUrl).then(data => {
                    setBadge(data.status);
                    if (data.status === 'pending' || data.status === 'approved') {
                        document.getElementById('ai-analysis-text').value = data.text ?? '';
                        stopPolling();
                        location.reload();
                    } else if (data.status === 'failed') {
                        stopPolling();
                        const btnText = document.getElementById('btn-ai-generate-text');
                        if (btnText) btnText.textContent = 'Retry AI Analysis';
                        const btn = document.getElementById('btn-ai-generate');
                        if (btn) btn.disabled = false;
                        alert('AI generation failed. The API may be busy — please try again in a minute.');
                    }
                }).catch(() => { /* keep polling */ });
            }, 3000);
        }

        // GENERATE
        const btnGenerate = document.getElementById('btn-ai-generate');
        if (btnGenerate) {
            btnGenerate.addEventListener('click', function() {
                const url       = this.dataset.url;
                const statusUrl = this.dataset.statusUrl;
                const btnText   = document.getElementById('btn-ai-generate-text');

                btnText.textContent = '⏳ Generating…';
                btnGenerate.disabled = true;
                setBadge('processing');

                aiPost(url, {}).then(data => {
                    if (data.status === 'processing') {
                        startPolling(statusUrl);
                    } else if (data.error) {
                        alert('Error: ' + data.error);
                        btnText.textContent = 'Generate AI Analysis';
                        btnGenerate.disabled = false;
                        setBadge('none');
                    }
                }).catch(() => {
                    alert('Request failed. Check your connection.');
                    btnText.textContent = 'Generate AI Analysis';
                    btnGenerate.disabled = false;
                });
            });
        }

        // APPROVE
        const btnApprove = document.getElementById('btn-ai-approve');
        if (btnApprove) {
            btnApprove.addEventListener('click', function() {
                const url = this.dataset.url;
                const editedText = document.getElementById('ai-analysis-text').value;
                btnApprove.disabled = true;
                aiPost(url, { ai_analysis: editedText }).then(data => {
                    if (data.status === 'approved') { setBadge('approved'); location.reload(); }
                }).catch(() => alert('Approve request failed.'))
                  .finally(() => btnApprove.disabled = false);
            });
        }

        // REJECT
        const btnReject = document.getElementById('btn-ai-reject');
        if (btnReject) {
            btnReject.addEventListener('click', function() {
                if (!confirm('Reject and clear this AI analysis? The farmer will not see it.')) return;
                const url = this.dataset.url;
                btnReject.disabled = true;
                aiPost(url, {}).then(data => {
                    if (data.status === 'rejected') {
                        document.getElementById('ai-analysis-text').value = '';
                        setBadge('rejected');
                        location.reload();
                    }
                }).catch(() => alert('Reject request failed.'))
                  .finally(() => btnReject.disabled = false);
            });
        }

        // Resume polling if loading while processing
        const badge = document.getElementById('ai-status-badge');
        if (badge && badge.textContent.trim() === '⏳ Generating…') {
            const btn = document.getElementById('btn-ai-generate');
            if (btn) startPolling(btn.dataset.statusUrl);
        }
    })();
    </script>

@endsection
