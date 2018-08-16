@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-sm-4">


        <form action="{{ route('sessions.store') }}" method="POST" class="form__auth">
            {!! csrf_field() !!}

            @if ($return = request('return'))
                <input type="hidden" name="return" value="{{ $return }}">
            @endif

            <div class="page-header">
                <h4>
                    {{ trans('auth.sessions.title') }}
                </h4>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="email" name ="email" class="form-control" placeholder="{{ trans('auth.form.email') }}" value="{{ old('email') }}" autofocus />
                {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="{{ trans('auth.form.password') }}">
                {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" value="{{ old('remember', 1) }}" checked>
                        {{ trans('auth.sessions.remember') }}
                        <span class="text-danger">
                            {{ trans('auth.sessions.remember_help') }}
                        </span>
                    </label>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    {{ trans('auth.sessions.login_with_email') }}
                </button>
            </div>

            <div class="form-group">
                    <a href="{{ url('/auth/facebook') }}" class="button btn btn-primary btn-lg btn-block social_login">{{ trans('auth.sessions.login_with_facebook') }}</a>
            </div>

            <div class="form-group">
                    <a href="{{ url('/auth/naver') }}" class="button btn btn-primary btn-lg btn-block social_login">{{ trans('auth.sessions.login_with_naver') }}</a>
            </div>

            <div>
                <p class="text-center">
                </p>
                <p class="text-center">
                </p>
            </div>

        </form>

        </div>
    </div>
@stop