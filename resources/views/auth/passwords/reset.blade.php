@extends('layouts.frontend.master', ['title' => trans('dashboard.auth.reset.title'), 'bodyClass' => 'homepage'])

@section('content')
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="auth-form col-md-6 col-sm-12">
                    <h1 class="text-primary font-weight-600 mb-3">
                        @lang('dashboard.auth.reset.title')
                    </h1>
                    <p class="font-weight-500 lead">
                        @lang('dashboard.auth.reset.info')
                    </p>

                    {{ BsForm::resource('customers')->post(route('password.update')) }}
                        {{ BsForm::hidden('token', $token) }}
                        {{ BsForm::password('password') }}
                        {{ BsForm::password('password_confirmation') }}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">
                                        @lang('dashboard.auth.reset.submit')
                                    </button>
                        
                                    <small class="mt-3 d-block">
                                        <a class="btn btn-link btn-sm" href="{{ route('login') }}">
                                            @lang('dashboard.auth.login.title')
                                        </a>
                                    </small>
                                </div>
                            </div>
                        </div>
                    {{ BsForm::close() }}
                </div>

                <div class="col-12 pb-5"></div>
            </div>
        </div>
    </section>
    
    <aside class="sidebar col-lg-6 col-md-6 col-sm-12">
		<ul class="list-unstyled pl-0 pl-md-5">
            @foreach(trans('frontend.features') as $feature)
                <li class="media">
                    <div class="bg-white rounded mr-3 p-3">
                        <img src="{{ $feature['icon'] }}" class="img-fluid" alt="{{ $feature['title'] }}">
                    </div>
                    <div class="media-body font-weight-500">
                        <h5 class="mt-0 mb-2 text-white font-weight-600">{{ $feature['title'] }}</h5>
                        {{ $feature['description'] }}
                    </div>
                </li>
            @endforeach
		</ul>
    </aside>
@endsection