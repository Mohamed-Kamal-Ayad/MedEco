@extends('layouts.frontend.master', ['title' => trans('dashboard.auth.register.title'), 'bodyClass' => 'homepage'])

@section('content')
    <section class="pt-4">
        <div class="container">
            <div class="row">
                <div class="auth-form col-md-6 col-sm-12">
                    <h1 class="text-primary font-weight-600 mb-3">
                        @lang('dashboard.auth.register.title')
                    </h1>
                    <p class="font-weight-500 lead">
                        @lang('dashboard.auth.register.info')
                    </p>

                    <div class="form-group">
                        <a href="{{ route('auth.socialite', 'google') }}" class="btn btn-google mt-4 w-100">
                            <i class="mr-2 fab fa-google"></i>
                            @lang('dashboard.auth.register.google')
                        </a>
                        <a href="{{ route('auth.socialite', 'twitter') }}" class="btn btn-twitter mt-4 w-100">
                            <i class="mr-2 fab fa-twitter"></i>
                            @lang('dashboard.auth.register.twitter')
                        </a>
                        <a href="{{ route('auth.socialite', 'facebook') }}" class="btn btn-facebook mt-4 w-100">
                            <i class="mr-2 fab fa-facebook-f"></i>
                            @lang('dashboard.auth.register.facebook')
                        </a>
                    </div>

                    <div class="divider text-center position-relative my-4 font-weight-500">
                        <span class="bg-primary text-white d-block">@lang('frontend.or')</span>
                    </div>

                    {{ BsForm::resource('customers')->post(route('register')) }}
                        {{ BsForm::text('name') }}
                        {{ BsForm::email('email') }}
                        {{ BsForm::password('password') }}
                        {{ BsForm::password('password_confirmation') }}
                        <div class="text-center">
                            <small class="my-4 d-block">
                                @lang('dashboard.auth.register.acceptance')
                                <a href="{{ route('pages.show', 'terms') }}">
                                    <u>
                                        @lang('pages.terms')
                                    </u>
                                </a>
                                @lang('frontend.and')
                                <a href="{{ route('pages.show', 'privacy') }}">
                                    <u>
                                        @lang('pages.privacy')
                                    </u>
                                </a>
                                .
                            </small>
                
                            <button type="submit" class="btn btn-secondary w-100">
                                @lang('dashboard.auth.register.submit')
                            </button>
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