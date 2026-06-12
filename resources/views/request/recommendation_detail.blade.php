@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Recommendation Detail')
@section('content')

<div class="row mb-3">
    <div class="col-12">
        <a href="{{ route('recommendation.index') }}" class="btn btn-light">
            <i class="mdi mdi-arrow-left me-1"></i> Back to Recommendations
        </a>
    </div>
</div>

<div class="row">
    {{-- Farmer & Request Info --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title mb-3"><i class="mdi mdi-account-outline me-1"></i> Farmer & Request Info</h5>
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <th class="text-muted" style="width:40%">Recommendation ID</th>
                        <td>#{{ $recommendation->reco_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Farmer</th>
                        <td><strong>{{ $recommendation->farmerSampleRecRequest->farmer->farmer_name ?? 'N/A' }}</strong></td>
                    </tr>
                    <tr>
                        <th class="text-muted">Farm</th>
                        <td>{{ $recommendation->farmerSampleRecRequest->farm->farm_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Request ID</th>
                        <td>#{{ $recommendation->request_id }}</td>
                    </tr>
                    <tr>
                        <th class="text-muted">Status</th>
                        <td>
                            @if($recommendation->approved === 'Y' || $recommendation->approved === 1)
                                <span class="badge bg-success fs-6">Approved</span>
                            @else
                                <span class="badge bg-warning text-dark fs-6">Pending</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-muted">Date Created</th>
                        <td>{{ $recommendation->created_at ? $recommendation->created_at->format('d M Y') : 'N/A' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Notes & File --}}
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="header-title mb-3"><i class="mdi mdi-note-text-outline me-1"></i> Notes & File</h5>
                <p class="text-muted fw-bold mb-1">Notes</p>
                <div class="p-3 bg-light rounded mb-3" style="min-height:80px;">
                    {{ $recommendation->notes ?? 'No notes available.' }}
                </div>

                <p class="text-muted fw-bold mb-1">Recommendation File</p>
                @if($recommendation->file_path)
                    <a href="{{ route('recommendation.download', $recommendation->reco_id) }}" class="btn btn-info text-white">
                        <i class="mdi mdi-download me-1"></i> Download PDF
                    </a>
                @else
                    <p class="text-muted">No file has been uploaded yet.</p>
                @endif
            </div>
</div>

@if(($recommendation->ai_status ?? 'none') === 'approved' && $recommendation->ai_text)
<div class="row mb-3">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title mb-3">
                    <i class="mdi mdi-robot-outline me-1 text-primary"></i> 
                    AI Soil Analysis & Fertilizer Recommendation Report
                </h4>
                <div style="white-space: pre-line; line-height: 1.75; font-size: 0.95rem; font-family: 'Courier New', Courier, monospace; background-color: #f8f9fa; padding: 20px; border-radius: 6px; border: 1px solid #e3e6f0; overflow-x: auto;">{{ $recommendation->ai_text }}</div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row mb-4">
    <div class="col-12 d-flex gap-2">
        <a href="{{ route('recommendation.create', $recommendation->request_id) }}" class="btn btn-primary">
            <i class="mdi mdi-pencil me-1"></i> Edit Recommendation
        </a>
        @if($recommendation->file_path)
            <a href="{{ route('recommendation.download', $recommendation->reco_id) }}" class="btn btn-success">
                <i class="mdi mdi-download me-1"></i> Download File
            </a>
        @endif
    </div>
</div>

@endsection
