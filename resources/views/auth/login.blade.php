@extends('layouts.frontend.master', ['title' => trans('dashboard.auth.login.title'), 'bodyClass' => 'homepage'])

@section('content')
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="auth-form col-md-6 col-sm-12">
                    <h1 class="text-primary font-weight-600 mb-3">
                        @lang('dashboard.auth.login.title')
                    </h1>
                    <p class="font-weight-500 lead">
                        @lang('dashboard.auth.login.info')
                    </p>

                    <div class="form-group">
                        <a href="{{ route('auth.socialite', 'google') }}" class="btn btn-google mt-4 w-100">
                            <i class="mr-2 fab fa-google"></i>
                            @lang('dashboard.auth.login.google')
                        </a>
                        <a href="{{ route('auth.socialite', 'twitter') }}" class="btn btn-twitter mt-4 w-100">
                            <i class="mr-2 fab fa-twitter"></i>
                            @lang('dashboard.auth.login.twitter')
                        </a>
                        <a href="{{ route('auth.socialite', 'facebook') }}" class="btn btn-facebook mt-4 w-100">
                            <i class="mr-2 fab fa-facebook-f"></i>
                            @lang('dashboard.auth.login.facebook')
                        </a>
                    </div>

                    <div class="divider text-center position-relative my-4 font-weight-500">
                        <span class="bg-primary text-white d-block">@lang('frontend.or')</span>
                    </div>

                    {{ BsForm::resource('customers')->post(route('login')) }}
                        {{ BsForm::email('email') }}
                        {{ BsForm::password('password') }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="icheck-primary">
                                    <input type="checkbox"
                                           name="remember"
                                           {{ old('remember') ? 'checked' : '' }}
                                           id="remember">
                                    <label for="remember">
                                        @lang('dashboard.auth.login.remember')
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100">
                                        @lang('dashboard.auth.login.submit')
                                    </button>

                                    <small class="mt-3 d-block">
                                        @if(Route::has('password.request'))
                                            <a class="btn btn-link btn-sm" href="{{ route('password.request') }}">
                                                @lang('dashboard.auth.login.forget')
                                            </a>
                                        @endif
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
        @if(is_array(trans('frontend.features')))
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
        @endif
    </aside>
@endsection
