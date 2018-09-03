@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-sm-4">

        <form action="{{ route('users.store')  }}" method="POST" class="form__auth">
            {!! csrf_field() !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <input type="text" name="name" class="form-control" placeholder="이름 또는 닉네임" value="{{ old('name') }}" autofocus/>
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

            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="비밀번호 확인" />
                {!! $errors->first('password_confirmation', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('shop_id') ? 'has-error' : '' }}">
            <label><h5 class="tit_survey">사용하고 있거나 사용을 고려하고 있는 쇼핑몰 솔루션을 선택해주세요? </h5></label>
                <select name="shop_id" class="form-control" placeholder="쇼핑몰" value="{{ old('shop_id') }}">
                    <option value="" selected disabled hidden>쇼핑몰 선택</option>
                    @foreach($shoplists as $shoplist)
                        @if($shoplist->category === 'Shoppingmall' || $shoplist->category === 'etc' )
                        <option value="{{ $shoplist->id }}">{{ $shoplist->name }}</option>
                        @endif
                    @endforeach
                </select>
                {!! $errors->first('shop_id', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group {{ $errors->has('agree_term','agree_privacy')  ? 'has-error' : '' }}{{ $errors->has('agree_privacy') ? 'has-error' : '' }}">
                    <legend class="screen_out">샵피디 서비스 약관 및 개인정보 수집, 이용에 대한 동의</legend>
                    <div class="terms_box">
                        <h5 class="tit_agreement">서비스 약관 동의</h5>
                        <textarea class="terms-container" rows="5" id="terms_and_condition"></textarea>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="agree_terms" class="form-control form-check-input"  {{ (! empty(old('agree_terms')) ? 'checked' : '') }}>
                            </label>
                        </div>
                    </div>

                    <div class="terms_box down_box">
                        <h5 class="tit_agreement">개인정보 수집 및 이용 동의</h5>
                        <textarea class="terms-container" rows="5" id="privacy"></textarea>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="agree_privacy" class="form-control form-check-input">
                            </label>
                        </div>
                    </div>
                {!! $errors->first('agree_terms', '<span class="form-error">:message</span>') !!} <br/>
                {!! $errors->first('agree_privacy', '<span class="form-error">:message</span>') !!}
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    가입하기
                </button>
            </div>
            <div class="form-group">
                <a href="{{ url('/auth/facebook') }}" class="button btn btn-primary btn-lg btn-block social_login">{{ trans('auth.sessions.login_with_facebook') }}</a>
            </div>

            <div class="form-group">
                <a href="{{ url('/auth/naver') }}" class="button btn btn-primary btn-lg btn-block social_login">{{ trans('auth.sessions.login_with_naver') }}</a>
            </div>
        </form>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
                $.ajax({
                    url : "/files/terms_and_condition.txt",
                    dataType: "text",
                    success : function (data) {
                        $("#terms_and_condition").text(data);
                    }
                 });

                $.ajax({
                url : "/files/privacy.txt",
                dataType: "text",
                success : function (data) {
                    $("#privacy").text(data);
                    }
                });
        });
    </script>
@stop