@extends('layouts.app',['activePage' => 'user'])

@section('title','Create A User')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Create new user')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('admin/user') }}">{{__('user')}}</a></div>
            <div class="breadcrumb-item">{{__('Create user')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('User management panel')}}</h2>
        <p class="section-lead">{{__('Create user')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('admin/user') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{__('User Name')}}<span class="text-danger">&nbsp;*</span></label>
                            <input type="text" name="name" class="form-control @error('title') is_invalide @enderror" placeholder="{{__('User Name')}}" value="{{old('name')}}" required="">
                            @error('title')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">{{__('email')}}<span class="text-danger">&nbsp;*</span></label>
                            <input type="email" name="email_id" class="form-control @error('email_id') is_invalide @enderror" placeholder="{{__('Email')}}" value="{{old('email')}}" required="">
                            @error('email_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="phone">{{__('phone')}}<span class="text-danger">&nbsp;*</span></label>
                            <input type="number" min=1 name="phone" class="form-control @error('phone') is_invalide @enderror" placeholder="{{__('Phone')}}" value="{{old('phone')}}" required="">
                            @error('phone')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="password">{{__('password')}}<span class="text-danger">&nbsp;*</span></label>
                            <input type="password" name="password" class="form-control @error('password') is_invalide @enderror" placeholder="{{__('* * * * * *')}}" value="{{old('password')}}" required="">
                            @error('password')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('Add user')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
