@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Soil Analysis Detail')
@section('content')

<div class="row mb-3">
    <div class="col-12">
        <a href="{{ route('soil_sample_results.index') }}" class="btn btn-light">
            <i class="mdi mdi-arrow-left me-1"></i> Back to Soil Analysis
        </a>
    </div>
</div>

<div class="row">
    {{-- Farmer & Request Info --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title mb-3"><i class="mdi mdi-account-outline me-1"></i> Farmer Info</h5>
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <th class="text-muted" style="width:45%">Name</th>
                        <td>{{ $soil_sample->farmerRequest->farmer->farmer_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Farm</th>
                        <td>{{ $soil_sample->farmerRequest->farm->farm_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Request ID</th>
                        <td>#{{ $soil_sample->request_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Lab Number</th>
                        <td><span class="badge bg-secondary fs-6">{{ $soil_sample->laboratory_number ?? 'N/A' }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Lab User ID</th>
                        <td>{{ $soil_sample->lab_user_id ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Physical Properties --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title mb-3"><i class="mdi mdi-texture-box me-1"></i> Physical Properties</h5>
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <th class="text-muted" style="width:55%">pH (CaCl₂)</th>
                        <td><strong>{{ $soil_sample->ph_cacl2 ?? 'N/A' }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Colour</th>
                        <td>{{ $soil_sample->colour ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Texture</th>
                        <td>{{ $soil_sample->texture ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">% Sand</th>
                        <td>{{ $soil_sample->percentage_sand ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">% Silt</th>
                        <td>{{ $soil_sample->percentage_silt ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">% Clay</th>
                        <td>{{ $soil_sample->percentage_clay ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Min Initial N</th>
                        <td>{{ $soil_sample->min_initial_n ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Chemical Properties --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title mb-3"><i class="mdi mdi-atom me-1"></i> Chemical Properties</h5>
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <th class="text-muted" style="width:55%">P₂O₅ (ppm)</th>
                        <td>{{ $soil_sample->p2o5_ppm ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Potassium (K)</th>
                        <td>{{ $soil_sample->k ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Magnesium (Mg)</th>
                        <td>{{ $soil_sample->mg ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Calcium (Ca)</th>
                        <td>{{ $soil_sample->ca ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Zinc (Zn)</th>
                        <td>{{ $soil_sample->zn ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Copper (Cu)</th>
                        <td>{{ $soil_sample->cu ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Manganese (Mn)</th>
                        <td>{{ $soil_sample->mn ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Iron (Fe)</th>
                        <td>{{ $soil_sample->fe ?? 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title mb-3"><i class="mdi mdi-clipboard-list-outline me-1"></i> Lab Methods</h5>
                <div class="row">
                    <div class="col-md-4">
                        <p><strong>Texture Method:</strong> {{ $soil_sample->texturemethod ?? 'N/A' }}</p>
                        <p><strong>Phosphorous Method:</strong> {{ $soil_sample->phosphorousmethods ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Micronutrients Method:</strong> {{ $soil_sample->micronutrientsmethods ?? 'N/A' }}</p>
                        <p><strong>Exchangeable Method:</strong> {{ $soil_sample->exchangeablemethods ?? 'N/A' }}</p>
                    </div>
                    <div class="col-md-4">
                        <p><strong>pH Method:</strong> {{ $soil_sample->phmethod ?? 'N/A' }}</p>
                        <p><strong>Dilution Ratio:</strong> {{ $soil_sample->dilutionratio ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Approved AI Analysis (visible to farmer) ────────────────────── --}}
@if($soil_sample->ai_analysis_status === 'approved' && $soil_sample->ai_analysis)
<div class="row mt-2">
    <div class="col-12">
        <div class="card border-0" style="background: linear-gradient(135deg,#e8f5e9,#f1f8e9);">
            <div class="card-body">
                <h5 class="header-title mb-3">
                    <i class="mdi mdi-robot-outline me-1 text-success"></i>
                    AI Soil Analysis Interpretation
                    <span class="badge bg-success ms-2" style="font-size:0.75rem;">AI Verified</span>
                </h5>
                <div style="white-space:pre-line; line-height:1.75; font-size:0.95rem;">{{ $soil_sample->ai_analysis }}</div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row mb-4">
    <div class="col-12 d-flex gap-2">
        <a href="{{ route('soil_sample_results.create', $soil_sample->sample_id) }}" class="btn btn-primary">
            <i class="mdi mdi-flask me-1"></i> Edit Analysis
        </a>
        <a href="{{ route('recommendation.create', $soil_sample->request_id) }}" class="btn btn-success">
            <i class="mdi mdi-file-document me-1"></i> Recommendation
        </a>
@if($soil_sample->approved == 'Y')
        <a href="{{ route('soil_sample_results.generatePdf', $soil_sample->request_id) }}" class="btn btn-info text-white">
            <i class="mdi mdi-file-pdf me-1"></i> Download PDF
        </a>
    @endif
    </div>
</div>

@endsection
