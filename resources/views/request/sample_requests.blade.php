@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Farmer Requests')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="app-search  m-3">
                        <form action="{{ route('farmer_requests.search') }}" method="GET">
                            <div class="row g-2 align-items-center">
                                <div class="col-auto">
                                    <input type="date" name="start_date" class="form-control" value="{{ $start_date ?? '' }}" placeholder="Start Date" title="Start Date">
                                </div>
                                <div class="col-auto">
                                    <input type="date" name="end_date" class="form-control" value="{{ $end_date ?? '' }}" placeholder="End Date" title="End Date">
                                </div>
                                <div class="col-auto">
                                    <div class="input-group">
                                        <input type="search" name="search" class="form-control" value="{{ $search ?? '' }}"
                                            placeholder="Search by name, phone, or lab number..." id="top-search" style="min-width: 250px;">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                        <button class="input-group-text btn btn-primary" type="submit">Filter & Search</button>
                                        <a href="{{ route('farmer_requests.index') }}" class="input-group-text btn btn-light">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Requests</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Farmers</th>
                                <th>Farm Name</th>
                                <th>Postal Address</th>
                                <th>Contact Phone</th>
                                <th>Number of Samples</th>
                                <th>Earliest Date of Collection</th>
                                <th>Date Received</th>
                                <th>Date Sampled</th>
                                <th>Approve</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmerRequests as $farmerRequest)
                                <tr>
                                    <td>{{ $farmerRequest->farmer->farmer_name ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->farm->farm_name ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->postal_address ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->contact_phone ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->number_of_samples ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->earliest_date_of_collection ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->date_received ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->date_sampled ?? 'n/a' }}</td>
                                    <td>{{ $farmerRequest->approved ?? 'n/a' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Options</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('farmer_requests.create',$farmerRequest->request_id ?? '')}}">View</a>
                                            {{-- <a class="dropdown-item" href="#">Edit</a> --}}
                                           
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $farmerRequests->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
