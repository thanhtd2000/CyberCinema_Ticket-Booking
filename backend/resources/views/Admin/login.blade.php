@extends('Admin.layouts.login.footer')
@extends('Admin.layouts.login.master')
@extends('Admin.layouts.login.header')

@section('content')
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            <div class="message text-center">
                @if (session('message'))
                    <p class="aler text-danger pt-3 pb-3">
                        <strong>{{ session('message') }}</strong>
                    </p>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Đăng Nhập</h1>
                                <p class="text-medium-emphasis">Đăng nhập tài khoản của bạn</p>
                                <form action="{{ route('checkLogin') }}" method="POST">
                                    @csrf
                                    <div class="input-group mb-3"><span class="input-group-text">
                                            <svg class="icon">
                                                <use xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-user">
                                                </use>
                                            </svg></span>
                                        <input class="form-control" type="text" name="email" placeholder="Email"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="error">
                                        @if ($errors->has('email'))
                                            <span class="text-danger fs-6">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group mb-4"><span class="input-group-text">
                                            <svg class="icon">
                                                <use
                                                    xlink:href="../../../dist/vendors/@coreui/icons/svg/free.svg#cil-lock-locked">
                                                </use>
                                            </svg></span>
                                        <input class="form-control" name="password" type="password" placeholder="Password">
                                    </div>
                                    <div class="error">
                                        @if ($errors->has('password'))
                                            <p class="text-danger fs-6">
                                                {{ $errors->first('password') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="row">

                                        <div class=" d-flex">
                                            <input type="checkbox" name="remember">
                                            <label for="">Lưu đăng nhập</label>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary px-4" type="submit">Đăng nhập</button>
                                        </div>
                                </form>


                            </div>
                        </div>
                    </div>
                    <div class="card col-md-5 text-white bg-primary py-5">
                        <div class="card-body text-center">
                            <div>
                                <q class="fs-6">Có làm thì mới có ăn . Cần cù bù thông minh</q>
                                <br>
                                <cite>- Nhà Thơ nào đó</cite>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
