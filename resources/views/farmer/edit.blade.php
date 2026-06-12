@extends(Auth::check() && Auth::user()->role_id == 1 ? 'layouts.admin' : 'layouts.farmer')
@section('page_title', 'Edit Profile')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card mb-1 shadow-none border">
                <div class="card-body">
                    <h4>Edit Farmer Profile</h4>
                    <hr />
                    
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('farmer.profile.update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="farmer_name">First Name</label>
                                    <input type="text" class="form-control" id="farmer_name" name="farmer_name" value="{{ old('farmer_name', $farmer->farmer_name) }}" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="surname">Surname</label>
                                    <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname', $farmer->surname) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="contact_phone">Contact Phone</label>
                                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $farmer->contact_phone) }}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="region">Region</label>
                                    <input type="text" class="form-control" id="region" name="region" value="{{ old('region', $farmer->region) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="district">District</label>
                                    <input type="text" class="form-control" id="district" name="district" value="{{ old('district', $farmer->district) }}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="village">Village</label>
                                    <input type="text" class="form-control" id="village" name="village" value="{{ old('village', $farmer->village) }}">
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-4" />
                        <h5 class="mb-3">Change Password <small class="text-muted">(Leave blank to keep current password)</small></h5>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="current_password">Current Password</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="new_password">New Password</label>
                                    <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-group mb-3">
                                    <label for="new_password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <a href="{{ route('farmer.profile') }}" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
