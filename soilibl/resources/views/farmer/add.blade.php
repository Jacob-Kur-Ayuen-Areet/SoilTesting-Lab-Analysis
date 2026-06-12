@extends('layouts.master')
@section('page_title', 'Add Farmer')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class=" card mb-1 shadow-none border">
                <div class="card-body">
                    <h4>Farmer Information Form</h4>
                    <hr />
                    <form action="{{ route('farmers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="farmer_name">Full Name</label>
                                    <input type="text" class="form-control" id="farmer_name" name="farmer_name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Contact Phone</label>
                                    <input type="number" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="form-group">
                                    <label for="postal_address">Postal Address</label>
                                    <textarea type="text" class="form-control" id="postal_address" name="postal_address"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="district_id">District</label>
                                    <select class="form-control select2" data-toggle="select2" id="district_id" name="district_id">
                                        @php
                                            $districts = App\Models\District::get();
                                        @endphp
                                        @foreach($districts as $district)
                                            <option value="{{$district->district_id}}">{{$district->district_name}}</option>
                                        @endforeach
                                        <!-- Populate this select with options from the districts table -->
                                    </select>
                                </div>
                            </div>

                         
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Farmer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
