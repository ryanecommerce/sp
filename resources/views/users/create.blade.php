@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-sm-4">

        <form action="{{ route('users.store')  }}" method="POST" class="form__auth">
            {!! csrf_field() !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" placeholder="이름" value="{{ old('name') }}" autofocus/>
                {!! $errors->first('name', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <input type="text" name="email" class="form-control" placeholder="이메일" value="{{ old('email') }}"/>
                {!! $errors->first('email', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password" class="form-control" placeholder="비밀번호" />
                {!! $errors->first('password', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="비밀번호 확인" />
                {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group" {{ $errors->has('shop_id') ? 'has-error' : '' }}">
                <label>사용하고 있거나 사용을 고려하고 있는 쇼핑몰 솔루션을 선택해주세요? </label>
                <select name="shop_id" class="form-control" placeholder="쇼핑몰" value="{{ old('shop_id') }}">
                    <option value="" selected disabled hidden>쇼핑몰 선택</option>
                    @foreach($shoplists as $shoplist)
                        @if($shoplist->category === 'Shoppingmall')
                        <option value="{{ $shoplist->id }}">{{ $shoplist->name }}</option>
                        @endif
                    @endforeach
                </select>
                {!! $errors->first('shop_id', '<span class="form-error">:message</span>') !!}
            </div>


            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    가입하기
                </button>
            </div>
        </form>

        </div>
    </div>
@stop