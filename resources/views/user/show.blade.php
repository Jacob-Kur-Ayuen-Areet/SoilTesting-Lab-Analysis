@extends('layouts.admin')
@section('page_title', 'User Details')
@section('content')

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">User Details</h4>
                    
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $user->phone ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    @if($user->role_id == 1)
                                        <span class="badge bg-primary">Admin/Staff</span>
                                    @elseif($user->role_id == 2)
                                        <span class="badge bg-success">Farmer</span>
                                    @else
                                        <span class="badge bg-secondary">Unknown</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Registered At</th>
                                <td>{{ $user->created_at ? $user->created_at->format('Y-m-d H:i') : 'n/a' }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if($user->role_id == 2 && $user->farmer)
                        <h4 class="header-title mt-4 mb-3">Farmer Profile</h4>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>Farmer ID</th>
                                    <td>{{ $user->farmer->farmer_id }}</td>
                                </tr>
                                <tr>
                                    <th>Farmer Name</th>
                                    <td>{{ $user->farmer->farmer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact Phone</th>
                                    <td>{{ $user->farmer->contact_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $user->farmer->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Ward/District</th>
                                    <td>{{ $user->farmer->ward }}, {{ $user->farmer->district }}</td>
                                </tr>
                                <tr>
                                    <th>Action</th>
                                    <td>
                                        <a href="{{ route('farmers.show', $user->farmer->farmer_id) }}" class="btn btn-sm btn-info">View Full Farmer Profile</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @elseif($user->role_id == 2)
                        <div class="alert alert-warning mt-3">
                            This user is a Farmer, but their farmer profile is missing or incomplete.
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
