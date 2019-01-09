@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}<div style="float: right"><a href="{{url('profiles/'.$profile->id.'/edit')}}">Edit</a></div></div>

                <div class="card-body">
                    <div class="form-group row">
                    <div class="col-sm-4">Profile Pic</div>
                    <div class="col-md-6">
                        <img style="width: 50%" src="{{$profile->avatar_url}}">

                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-4">About Me</div>
                    <div class="col-md-6">
                        <div>{{$profile->about_me}}</div>

                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-4">Birthday</div>
                    <div class="col-md-6">
                        <div>{{$profile->birthday}}</div>

                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-4">Country</div>
                    <div class="col-md-6">
                        <div>{{$profile->country}}</div>

                    </div>
                    </div>

                    <div class="form-group row">
                    <div class="col-sm-4">City</div>
                    <div class="col-md-6">
                        <div>{{$profile->city}}</div>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



