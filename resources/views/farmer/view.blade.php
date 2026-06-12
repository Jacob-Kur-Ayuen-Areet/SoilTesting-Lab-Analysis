@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Farmer Requests')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="app-search  m-3">
                            <form action="{{ route('farmer.search') }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" value="{{ $search ?? '' }}"
                                        placeholder="Search..." id="top-search">
                                    <span class="mdi mdi-magnify search-icon"></span>
                                    <button class="input-group-text btn btn-primary" type="submit">Search</button>
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
                    <h4>Farmer</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Farmer</th>
                                <th>Postal Address</th>
                                <th>Contact Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmers as $farmer)
                                <tr>
                                    <td>{{ $farmer->farmer_name ?? 'n/a' }}</td>
                                    <td>{{ $farmer->postal_address ?? 'n/a' }}</td>
                                    <td>{{ $farmer->contact_phone ?? 'n/a' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Options</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('farmers.show', $farmer->farmer_id ?? '') }}">more</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $farmers->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
