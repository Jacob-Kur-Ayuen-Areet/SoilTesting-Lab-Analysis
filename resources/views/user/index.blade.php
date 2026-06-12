@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Users')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="app-search m-3">
                            <form action="{{ route('users.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="search" name="search" class="form-control" value="{{ $search ?? '' }}"
                                        placeholder="Search by name, email, or phone..." id="top-search">
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
                    <h4>System Users</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Registered At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}">{{ $user->name ?? 'n/a' }}</a>
                                    </td>
                                    <td>{{ $user->email ?? 'n/a' }}</td>
                                    <td>{{ $user->phone ?? 'n/a' }}</td>
                                    <td>
                                        @if($user->role_id == 1)
                                            <span class="badge bg-primary">Admin/Staff</span>
                                        @elseif($user->role_id == 2)
                                            <span class="badge bg-success">Farmer</span>
                                        @else
                                            <span class="badge bg-secondary">Unknown</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : 'n/a' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->appends(['search' => $search])->links('vendor/pagination/bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
