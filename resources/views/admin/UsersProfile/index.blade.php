@extends('admin.layout.master')
@section('content')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Thông tin đầy đủ của nhân viên</h1>

        <div class="row" style="align-items: center" >
            <div class="col-md-4" style="border: 1px solid black">
                <img src="{{ asset('images').'/'.$user->image_url }}" alt="Profile Picture" class="img-fluid mb-3">
            </div>
            <div class="col-md-8"  >
                <dl class="row">
                    <dt class="col-sm-3"><h2>Name:</h2></dt>
                    <dd class="col-sm-9"><h3>{{ $user->name }}</h3></dd>

                    <dt class="col-sm-3"><h2>Lương:</h2></dt>
                    <dd class="col-sm-9"><h3>{{ $user->price }}$</h3></dd>

                    <dt class="col-sm-3"><h2>Chức vụ:</h2></dt>
                    <dd class="col-sm-9"><h3>{{  $user->productCategory->name }}</h3></dd>
                </dl>
            </div>
        </div>

        <hr class="my-4">

        <h2 class="mb-3">Giới thiệu:</h2>
        <p class="text-center"><em>{!! $user->short_description !!}</em></p>

        <hr class="my-4">



        <hr class="my-4">

        <h2 class="mb-3">Thông tin:</h2>
        <p>
            {!! $user->description !!}
        </p>

        <hr class="my-4">

        <marquee><strong><font color="red">Trang thông tin</font></strong></marquee>
    </div>

@endsection
