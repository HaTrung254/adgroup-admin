@extends('layouts.master')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            ADGROUP
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Đăng nhập</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="text"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="name"
                               value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <span class="fa fa-user input-group-text"></span> @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                               required>
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span> @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                        </div>
                    </div>
                    <div class="row">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{--<p class="mb-1">--}}
                {{--<a href="#">I forgot my password</a>--}}
                {{--</p>--}}
                {{--<p class="mb-0">--}}
                {{--<a href="{{route('register')}}" class="text-center">Register a new membership</a>--}}
                {{--</p>--}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection