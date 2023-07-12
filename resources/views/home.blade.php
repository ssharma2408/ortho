@extends('layouts.layout')

@section('page')

<div>Home</div>

@endsection

@section('content')

<div class="mb-3">
    <img class="img-fluid" src="{{ asset('img/Book-an-Appointment_banner.jpg') }}" alt="Book-an-Appointment_banner">
</div>


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
@if (!Session::has('close_status'))
	<a href="{{route('patient.login.show')}}" class="btn btn-secondary btn-rounded ">Book an Appointment</a>
@endif
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
<div class="section-block my-5">
<div class="row">
    <div class="col-lg-5 col-md-6 mx-auto">
     
            <div class="text-center">
                <div class="section-title pt-0">
                    <h3 class="title-lg">Book your doctor appointment today!</h3>
                    <p class="text-descripstion secondary-text mb-0">you can trust for all your healthcare needs. </p>
                </div>
				@if (!Session::has('close_status'))
					<a href="{{route('patient.login.show')}}" class="btn btn-secondary btn-rounded ">Book an Appointment</a>
				@endif
            </div>
     
    </div>
</div>
</div>
@endif
@endsection

@push('js')

@endpush