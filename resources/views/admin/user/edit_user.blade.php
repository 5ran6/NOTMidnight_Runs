@extends('layouts.app',['activePage' => 'user'])

@section('title','Edit User')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Edit user')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ url('admin/user') }}">{{__('user')}}</a></div>
            <div class="breadcrumb-item">{{__('Edit user')}}</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">{{__('User management panel')}}</h2>
        <p class="section-lead">{{__('Edit User')}}</p>
        <div class="card">
            <div class="card-body">
                <form class="container-fuild" action="{{ url('admin/user/'.$user->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">{{__('user name')}}</label>
                            <input type="text" name="name" class="form-control @error('name') is_invalide @enderror" placeholder="{{__('User Name')}}" value="{{ $user->name }}" required="" style="text-transform: none;">
                            @error('name')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="email">{{__('email')}}</label>
                            <input type="email" name="email" class="form-control @error('email') is_invalide @enderror" placeholder="{{__('Email')}}" value="{{ $user->email }}" readonly style="text-transform: none;">
                            @error('email')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="phone">{{__('phone')}}</label>
                            <input type="number" name="phone" class="form-control @error('phone') is_invalide @enderror" placeholder="{{__('Phone')}}" value="{{ $user->phone }}" required="" style="text-transform: none;">
                            @error('phone')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="password">{{__('New password')}}</label>
                            <input type="password" name="password" class="form-control @error('password') is_invalide @enderror" placeholder="{{__('* * * * * *')}}" value="{{old('password')}}" style="text-transform: none;">
                            @error('password')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary" type="submit">{{__('update user')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection
