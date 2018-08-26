@extends('layouts.app')

@section('content')
    <div class="row justify-content-md-center">
        <div class="col-sm-4">

            <form action="{{ route('social.update')  }}" method="POST" class="form__auth" id="form">
                {!! csrf_field() !!}

                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="{{ $authUser["name"] }}"/>
                </div>

                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="{{ $authUser["email"] }}"/>
                </div>

                <input id="provider_id" name="provider_id" type="hidden" value="{{ $authUser["provider_id"] }}">

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
                        <textarea class="terms-container" rows="5">온라인상의 인터넷 서비스(이하 “서비스”라고 하며, 접속 가능한 유∙무선 단말기의 종류와는 상관없이 이용 가능한 “회사”가 제공하는 모든 “서비스”를 의미합니다. 이하 같습니다)에 회원으로 가입하고 이를 이용함에 있어 회사와 회원(본 약관에 동의하고 회원등록을 완료한 서비스 이용자를 말합니다. 이하 “회원”이라고 합니다)의 권리•의무 및 책임사항을 규정함을 목적으로 합니다.</textarea>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="agree_terms" class="form-control form-check-input"  {{ (! empty(old('agree_terms')) ? 'checked' : '') }}>
                            </label>
                        </div>
                    </div>

                    <div class="terms_box down_box">
                        <h5 class="tit_agreement">개인정보 수집 및 이용 동의</h5>
                        <textarea class="terms-container" rows="5">온라인상의 인터넷 서비스(이하 “서비스”라고 하며, 접속 가능한 유∙무선 단말기의 종류와는 상관없이 이용 가능한 “회사”가 제공하는 모든 “서비스”를 의미합니다. 이하 같습니다)에 회원으로 가입하고 이를 이용함에 있어 회사와 회원(본 약관에 동의하고 회원등록을 완료한 서비스 이용자를 말합니다. 이하 “회원”이라고 합니다)의 권리•의무 및 책임사항을 규정함을 목적으로 합니다.</textarea>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" name="agree_privacy" class="form-control form-check-input">
                            </label>
                        </div>
                    </div>
                    <label class="errorTxt"></label>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">
                        가입하기
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#form').validate({ // initialize the plugin
                rules: {
                    shop_id: {
                        required: true
                    },
                    agree_terms: {
                        required: true
                    },
                    agree_privacy: {
                        required: true
                    },
                },
                messages: {
                    shop_id: "* 쇼핑몰을 선택해주세요.",
                    agree_terms: "* 서비스 약관 동의해 주세요.",
                    agree_privacy: "* 개인정보 수집 및 이용에 동의해 주세요.",
                },
                errorPlacement: function (error, element) {
                    if (element[0].type == 'checkbox') {
                        error.appendTo('.errorTxt');
                    }
                    else {
                        error.insertAfter(element);
                    }
                },
            });

        });
    </script>
@stop
