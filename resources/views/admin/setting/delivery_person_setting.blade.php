@extends('layouts.app',['activePage' => 'setting'])

@section('title','Delivery Person Setting')

@section('content')
<section class="section">
    @if (Session::has('msg'))
        <script>
            var msg = "<?php echo Session::get('msg'); ?>"
            $(window).on('load', function()
            {
                iziToast.success({
                    message: msg,
                    position: 'topRight'
                });
                console.log(msg);
        });
        </script>
    @endif
    <div class="section-header">
        <h1>{{__('Delivery person settings')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('admin/setting') }}">{{__('Setting')}}</a></div>
            <div class="breadcrumb-item">{{__('Delivery person setting')}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('Delivery person Setting management')}}</h2>
        <p class="section-lead">{{__('Delivery person setting')}}</p>
        <form action="{{ url('admin/update_delivery_person_setting') }}" method="post">
            @csrf
            <div class="card p-2">
                <div class="card-body">
                    <h5 class="mt-3">{{__('Delivery person setting')}}</h5>
                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="Delivery Person Accept Multiple Order">{{__('Delivery Person Accept Multiple Order?')}}</label><br>
                            <label class="switch">
                                <input type="checkbox" name="is_driver_accept_multipleorder" {{ $general_setting->is_driver_accept_multipleorder == 1 ? 'checked' : '' }}>
                                <div class="slider"></div>
                            </label>
                        </div>

                        <div class="col-md-6 driver_accept_multi_order {{ $general_setting->is_driver_accept_multipleorder == 0 ? 'hide' : '' }}">
                            <label for="Delivery Person Accept Multiple Order Count">{{__('Delivery Person Accept Multiple Order Count')}}</label>
                            <input type="text" name="driver_accept_multiple_order_count" class="form-control" value="{{ $general_setting->driver_accept_multiple_order_count }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="driver assign km">{{__('driver assign km')}}</label>
                            <input type="text" required name="driver_assign_km" class="form-control" value="{{ $general_setting->driver_assign_km }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="driver assign km">{{__('Driver dashboard auto refresh(In seconds)')}}</label>
                            <input type="number" min=1 required name="driver_auto_refrese" class="form-control" value="{{ $general_setting->driver_auto_refrese }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-2">
                <div class="card-body">
                    <h5 class="mt-3">{{__('Delivery person Vehical')}}</h5>
                    <hr>
                    <table class="table driver_vehical_table">
                        <thead>
                            <tr>
                                <th>{{__('Vehicle Type')}}</th>
                                <th>{{__('License Required')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($general_setting->driver_vehical_type != null)
                                @php
                                    $driver_vehical_types = json_decode($general_setting->driver_vehical_type)
                                @endphp
                                @foreach ($driver_vehical_types as $driver_vehical_type)
                                <tr>
                                    <td>
                                        <input type="text" name="vehical_type[]" value="{{ $driver_vehical_type->vehical_type }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <select name="license[]" class="form-control">
                                            <option value="yes" {{ $driver_vehical_type->license == 'yes' ? 'selected' : '' }}>{{__('Yes')}}</option>
                                            <option value="no" {{ $driver_vehical_type->license == 'no' ? 'selected' : '' }}>{{__('no')}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removebtn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="vehical_type[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <select name="license[]" class="form-control">
                                            <option value="yes">{{__('Yes')}}</option>
                                            <option value="no">{{__('no')}}</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removebtn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" onclick="add_drivervehical_field()">{{__('Add Field')}}</button>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="mt-3">{{__('Delivery person Earning')}}</h5>
                    <hr>
                    <table class="table driver_earning_table">
                        <thead>
                            <tr>
                                <th>{{__('Minimum KM')}}</th>
                                <th>{{__('Maximum KM')}}</th>
                                <th>{{__('Delivery Person charges')}}({{ $currency_symbol }})</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($general_setting->driver_earning != null)
                                @php
                                    $driver_earnings = json_decode($general_setting->driver_earning)
                                @endphp
                                @foreach ($driver_earnings as $driver_earning)
                                <tr>
                                    <td>
                                        <input type="number" min=1 name="min_km[]" value="{{ $driver_earning->min_km }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="number" min=1 name="max_km[]" value="{{ $driver_earning->max_km }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="number" min=1 name="charge[]" value="{{ $driver_earning->charge }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removebtn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="number" name="min_km[]" min=1 class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="number" name="max_km[]" min=1 class="form-control" required>
                                    </td>
                                    <td>
                                        <input type="number" name="charge[]" min=1 class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removebtn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" onclick="add_driverearning_field()">{{__('Add Field')}}</button>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="mt-3">{{__('Cancel reasons')}}</h5>
                    <hr>
                    <table class="table cancel_reason">
                        <thead>
                            <tr>
                                <th>{{__('Cancel reason')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($general_setting->cancel_reason != null)
                                @php
                                    $cancel_reasons = json_decode($general_setting->cancel_reason)
                                @endphp
                                @foreach ($cancel_reasons as $cancel_reason)
                                <tr>
                                    <td>
                                        <input type="text" name="cancel_reason[]" value="{{ $cancel_reason }}" class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removebtn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        <input type="text" name="cancel_reason[]" class="form-control" required>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger removebtn"><i class="fas fa-times"></i></button>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="text-center mt-3">
                        <button type="button" class="btn btn-primary" onclick="add_cancel_reason()">{{__('Add Field')}}</button>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-5">{{__('save')}}</button>
                </div>
            </div>

        </form>
    </div>
</section>
@endsection
