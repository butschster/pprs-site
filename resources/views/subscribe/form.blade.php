@extends('layout.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('subscribe') }}
@endsection

@section('banner')
    <div class="card">
        <img src="https://dummyimage.com/800x200/666/fff&text=Subscribe" class="card-img-top">
    </div>
@endsection

@section('content')
    <p class="lead">Подпишитесь на рассылку, чтобы не пропустить новости об инновационных методах лечения рассеяного склероза и его формы - первично-прогрессирующего рассеяного склероза.</p>
    <p class="lead">Мы хотим делиться информацией о том, как вести максимально полноценную жизнь каждый день пациентам с этим диагнозом.</p>

    <form class="py-5 " method="POST" action="{{ route('subscribe') }}">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" class="form-control form-control-lg {{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail" placeholder="Enter email" name="email">

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group mb-5">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control form-control-lg {{ $errors->has('name') ? ' is-invalid' : '' }}" id="exampleInputName" placeholder="Enter name" name="name">

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <button type="submit" class="btn btn-lg btn-primary">Подписаться на рассылку</button>
    </form>
@endsection