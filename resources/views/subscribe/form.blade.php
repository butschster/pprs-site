@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('subscribe') }}
@endsection

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner top-banner--news">
        <div class="top-banner__container main-container">
            <div class="top-banner__text">
                <div class="top-banner__strong">Первично-прогрессирующий рассеянный склероз</div>
                <div class="top-banner__small">информационный портал для пациентов и их родственников</div>
            </div>
            <h1 class="top-banner__title">Подписка</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="subscribe main-container">
        @if(!session()->has('success'))
            <p class="subscribe__text">Подпишитесь на рассылку, чтобы не пропустить новости об инновационных методах
                лечения рассеянного склероза и его особого типа течения - первично-прогрессирующего рассеянного
                склероза.</p>
            <p class="subscribe__text mb-5">Мы хотим делиться информацией о том, как вести максимально полноценную жизнь
                людям с РС каждый день.</p>

            <form class="w-100 w-md-80 w-lg-50" method="POST" action="{{ route('subscribe') }}">
                @csrf

                <div class="form-group row mb-4 align-items-baseline">
                    <label for="exampleInputName" class="col-sm-2 mb-0">Имя</label>
                    <div class="col-sm-10 col-lg-6">
                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputName" placeholder="Ваше имя" name="name" value="{{ old('name') }}">
                    </div>

                    @if ($errors->has('name'))
                    <span class="help-text col-sm-10 col-lg-6 offset-sm-2" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group row mb-4 align-items-baseline">
                    <label for="exampleInputEmail" class="col-sm-2 mb-0">Email</label>
                    <div class="col-sm-10 col-lg-6">
                        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}"
                               id="exampleInputEmail" placeholder="Ваш email" name="email">
                    </div>

                    @if ($errors->has('email'))
                    <span class="help-text col-sm-10 col-lg-6 offset-sm-2" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>


                <div class="form-group row mb-5 align-items-baseline">
                    <div class="col-sm-2 mb-0"></div>
                    <div class="col-sm-10 col-lg-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="agreement" value="1" @if(old('agreement') == 1) checked @endif
                                   id="agreement-rules">
                            <label class="custom-control-label" for="agreement-rules">
                                Я согласен <a href="{{ asset('personal_data_operator_policy.pdf') }}" target="_blank">с условиями обработки персональных данных</a>
                            </label>
                        </div>

                        @if ($errors->has('agreement'))
                            <span class="help-text" role="alert">
                                <strong>{{ $errors->first('agreement') }}</strong>
                            </span>
                        @endif

                        <div class="text-muted mt-3">
                            Продолжая использовать наш сайт, вы даете согласие на обработку файлов cookie,
                            пользовательских данных (сведения о местоположении; тип и версия ОС; тип и версия Браузера;
                            тип устройства и разрешение его экрана; источник откуда пришел на сайт пользователь; с
                            какого сайта или по какой рекламе; язык ОС и Браузера; какие страницы открывает и на какие
                            кнопки нажимает пользователь; ip-адрес) в целях функционирования сайта, проведения
                            ретаргетинга и проведения статистических исследований и обзоров. Если вы не хотите, чтобы
                            ваши данные обрабатывались, покиньте сайт.
                            Предоставляя свои данные, вы подтверждаете, что ознакомились с нашей <a href="{{ asset('personal_data_operator_policy.pdf') }}" target="_blank">Политикой оператора</a> в
                            отношении обработки персональных данных и согласны получать электронные сообщения сайта
                            pprs.ru при поддержке компании Roche.
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-subscribe col-sm-10 col-lg-6 offset-sm-2">Подписаться на рассылку</button>
            </form>
        @else
            <p class="subscribe__text">Спасибо за подписку!</p>
        @endif
    </div>
@endsection
