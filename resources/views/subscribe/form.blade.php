@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('subscribe') }}
@endsection

@section('banner')
    <div class="jumbotron jumbotron-fluid top-banner top-banner--main">
        <div class="top-banner__container main-container">
            <strong class="d-block mb-1">Первично-прогрессирующий рассеянный склероз</strong>
            <p class="top-banner__text">Информационный портал для пациентов и их родственников</p>
            <h1 class="top-banner__title">Подписка</h1>
        </div>
    </div>
@endsection

@section('content')
    <div class="subscribe main-container">
        <p class="subscribe__text">Подпишитесь на рассылку, чтобы не пропустить новости об инновационных методах лечения рассеяного склероза и его формы - первично-прогрессирующего рассеяного склероза.</p>
        <p class="subscribe__text mb-5">Мы хотим делиться информацией о том, как вести максимально полноценную жизнь каждый день пациентам с этим диагнозом.</p>

        <form class="w-100 w-md-80 w-lg-50" method="POST" action="{{ route('subscribe') }}">
            @csrf

            <div class="form-group  row mb-4">
                <label for="exampleInputName" class="col-sm-2">Имя</label>
                <input type="text" class="form-control col-sm-10 col-lg-6 {{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputName" placeholder="Ваше имя" name="name">

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group row mb-5">
                <label for="exampleInputEmail" class="col-sm-2">Email</label>
                <input type="email" class="form-control col-sm-10 col-lg-6 {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail" placeholder="Ваш email" name="email">

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
            </div>

            <button type="submit" class="btn btn-subscribe col-sm-10 col-lg-6 offset-sm-2">Подписаться на рассылку</button>
        </form>
    </div>
@endsection
