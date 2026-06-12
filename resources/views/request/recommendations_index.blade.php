@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Recommendations')
@section('content')

    {{-- Search Bar --}}
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-2">
                    <form action="{{ route('recommendation.index') }}" method="GET" class="d-flex align-items-center">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
                                value="{{ $search ?? '' }}"
                                placeholder="Search by farmer name or notes..."
                                id="rec-search">
                            <button class="btn btn-primary" type="submit">
                                <i class="mdi mdi-magnify"></i> Search
                            </button>
                            @if(!empty($search))
                                <a href="{{ route('recommendation.index') }}" class="btn btn-light">Clear</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Results Table --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-3">
                        Recommendations
                        @if(!empty($search))
                            <small class="text-muted fs-6"> — results for "{{ $search }}"</small>
                        @endif
                    </h4>

                    @if($Recommendations->isEmpty())
                        <div class="text-center text-muted py-5">
                            <i class="mdi mdi-file-document-outline fs-1 d-block mb-2"></i>
                            <p>No recommendations found.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered align-middle mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Farmer</th>
                                        <th>Request ID</th>
                                        <th>Approved</th>
                                        <th>Notes</th>
                                        <th>File</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Recommendations as $rec)
                                        <tr style="cursor: pointer;"
                                            onclick="window.location='{{ route('recommendation.show', $rec->reco_id) }}'">
                                            <td>{{ $rec->reco_id }}</td>
                                            <td>
                                                <strong>{{ $rec->farmerSampleRecRequest->farmer->farmer_name ?? 'N/A' }}</strong>
                                            </td>
                                            <td>#{{ $rec->request_id }}</td>
                                            <td>
                                                @if($rec->approved === 'Y' || $rec->approved === 1)
                                                    <span class="badge bg-success">Approved</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ Str::limit($rec->notes, 50) ?? 'N/A' }}</td>
                                            <td onclick="event.stopPropagation()">
                                                @if($rec->file_path)
                                                    <a href="{{ route('recommendation.download', $rec->reco_id) }}" class="btn btn-sm btn-info text-white">
                                                        <i class="mdi mdi-download"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">No file</span>
                                                @endif
                                            </td>
                                            <td onclick="event.stopPropagation()">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">Options</button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('recommendation.show', $rec->reco_id) }}">
                                                            <i class="mdi mdi-eye me-1"></i> View Details
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('recommendation.create', $rec->request_id) }}">
                                                            <i class="mdi mdi-pencil me-1"></i> Edit
                                                        </a>
                                                        @if($rec->file_path)
                                                            <a class="dropdown-item" href="{{ route('recommendation.download', $rec->reco_id) }}">
                                                                <i class="mdi mdi-download me-1"></i> Download File
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $Recommendations->links('vendor/pagination/bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
