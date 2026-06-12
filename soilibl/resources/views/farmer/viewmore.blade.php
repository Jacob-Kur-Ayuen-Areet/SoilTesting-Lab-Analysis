@extends('layouts.master')
@section('page_title', 'Farmer Requests')
@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Farmer</h4>
                    <table class="table table-bordered">

                        <tbody>

                            <tr>
                                <th>Farmer Name</th>
                                <td>{{ $farmer->farmer_name ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $farmer->postal_address ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $farmer->contact_phone ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ $farmer->contact_phone ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>District</th>
                                <td>{{ $farmer->contact_phone ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Province</th>
                                <td>{{ $farmer->contact_phone ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $farmer->contact_phone ?? 'n/a' }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">Options</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item"
                                            href="{{ route('farmer_requests.verifyfarmer', $farmer->user_id ?? '') }}">Create</a>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4>Add Farm</h4>
                    <hr />
                    <form action="{{ route('farms.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <input type="text" class="form-control" id="farmer_id"
                                    value="{{ $farmer->farmer_id ?? '' }}" name="farmer_id" hidden>
                                <div class="form-group">
                                    <label for="farmer_name">Farm Name</label>
                                    <input type="text" class="form-control" id="farm_name" name="farm_name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Size</label>
                                    <input type="text" class="form-control" id="size" name="size">
                                </div>
                                <div class="form-group">
                                    <label for="contact_phone">Contact Phone</label>
                                    <input type="number" class="form-control" id="contact_phone"
                                        value="{{ $farmer->contact_phone ?? '' }}" name="contact_phone">
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <textarea type="text" class="form-control" id="postal_address" name="postal_address">{{ $farmer->postal_address ?? '' }}</textarea>
                                </div>

                                {{-- <div class="form-group">
                                    <label for="province_id">Province</label>
                                    <select class="form-control" id="province_id" name="province_id">
                                        <!-- Populate this select with options from the provinces table -->
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="province_id">Location Coordinates</label>
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="lat">Latitude</label>
                                            <input type="lat" class="form-control" id="lat" name="lat">
                                        </div>

                                        <div class="col-6">
                                            <label for="long">Longitude</label>
                                            <input type="long" class="form-control" id="long" name="long">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Farm</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Farm</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Farm Name</th>
                                <th>Postal Address</th>
                                <th>Contact Phone</th>
                                <th>Size</th>
                                <th>Lat</th>
                                <th>Long</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmer->farm as $farm)
                                <tr>
                                    <td>{{ $farm->farm_name ?? 'n/a' }}</td>
                                    <td>{{ $farm->postal_address ?? 'n/a' }}</td>
                                    <td>{{ $farm->contact_phone ?? 'n/a' }}</td>
                                    <td>{{ $farm->size ?? 'n/a' }}</td>
                                    <td>{{ $farm->lat ?? 'n/a' }}</td>
                                    <td>{{ $farm->long ?? 'n/a' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">Options</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('farms.show',$farm->farm_id ?? '')}}">more</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{ $farmer->farm->links('vendor/pagination/bootstrap-4') }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection
