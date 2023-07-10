@extends('layouts.layout')

@section('page')

<div>Home</div>

@endsection

@section('content')

@if (Session::has('user_details'))

<!-- balance start -->
<div class="balance-area pd-top-40 mg-top-50">
    <div class="container">
        <div class="balance-area-bg balance-area-bg-home">
            <div class="balance-title text-center">
                <p>Welcome! <br> {{Session::get('user_details')->name}}</p>
            </div>
        </div>
    </div>
</div>
<!-- balance End -->

<!-- transaction start -->
<div class="transaction-area pd-top-36">
    <div class="container">
        <div class="section-title">
            <h3 class="title">My Dashboard</h3>
            <a href="#"><i class="fa fa-tachometer"></i></a>
        </div>
        <div class="ba-bill-pay-inner">
            <div class="ba-single-bill-pay">
                <div class="thumb">
                    <img src="{{ asset('img/icon/7.png') }}" alt="img">
                </div>
                <div class="details">
                    <h5>Lorem ipsum</h5>
                    <p>Duis aute irure dolor in reprehenderit in voluptate </p>
                </div>
            </div>
            <div class="amount-inner">
                <h5>***</h5>
                <a class="btn btn-red" href="#">Read</a>
            </div>
        </div>
    </div>
</div>
<!-- transaction End -->

@else
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card-box">
            <div class="text-center">
                <div class="section-title ">
                    <h3>Welcome! Guest User</h3>
                    <p class="mb-0">Have a nice day! </p>
                </div>
                <a href="{{route('patient.login.show')}}" class="btn btn-success ">Book an Appointment</a>
            </div>
        </div>
    </div>
</div>

@endif
@endsection

@push('js')

@endpush