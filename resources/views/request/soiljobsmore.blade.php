@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Soil Analysis')
@section('content')

    {{-- Search Bar --}}
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body py-2">
                    <form action="{{ route('soil_sample_results.search') }}" method="GET" class="d-flex align-items-center gap-2">
                        <div class="input-group">
                            <input type="search" name="search" class="form-control"
                                value="{{ $search ?? '' }}"
                                placeholder="Search by farmer name, lab number, colour or texture..."
                                id="soil-search">
                            <button class="btn btn-primary" type="submit">
                                <i class="mdi mdi-magnify"></i> Search
                            </button>
                            @if(!empty($search))
                                <a href="{{ route('soil_sample_results.index') }}" class="btn btn-light">Clear</a>
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
                        Soil Analysis Results
                        @if(!empty($search))
                            <small class="text-muted fs-6"> — results for "{{ $search }}"</small>
                        @endif
                    </h4>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Farmer</th>
                                    <th>Lab Number</th>
                                    <th>pH</th>
                                    <th>Colour</th>
                                    <th>Texture</th>
                                    <th>% Sand</th>
                                    <th>% Silt</th>
                                    <th>% Clay</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($soil_samples as $sample)
                                    <tr style="cursor: pointer;"
                                        onclick="window.location='{{ route('soil_sample_results.show', $sample->result_id) }}'">
                                        <td>{{ $sample->result_id }}</td>
                                        <td>
                                            <strong>{{ $sample->farmerRequest->farmer->farmer_name ?? 'N/A' }}</strong>
                                        </td>
                                        <td><span class="badge bg-secondary">{{ $sample->laboratory_number ?? 'N/A' }}</span></td>
                                        <td>{{ $sample->ph_cacl2 ?? 'N/A' }}</td>
                                        <td>{{ $sample->colour ?? 'N/A' }}</td>
                                        <td>{{ $sample->texture ?? 'N/A' }}</td>
                                        <td>{{ $sample->percentage_sand ?? 'N/A' }}</td>
                                        <td>{{ $sample->percentage_silt ?? 'N/A' }}</td>
                                        <td>{{ $sample->percentage_clay ?? 'N/A' }}</td>
                                        <td onclick="event.stopPropagation()">
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">Options</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('soil_sample_results.show', $sample->result_id) }}">
                                                        <i class="mdi mdi-eye me-1"></i> View Details
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('soil_sample_results.create', $sample->sample_id) }}">
                                                        <i class="mdi mdi-flask me-1"></i> Edit Analysis
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('recommendation.create', $sample->request_id ?? '') }}">
                                                        <i class="mdi mdi-file-document me-1"></i> Recommendation
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">
                                            <i class="mdi mdi-flask-empty-outline fs-2 d-block mb-2"></i>
                                            No soil analysis records found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $soil_samples->links('vendor/pagination/bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
