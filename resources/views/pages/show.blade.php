@extends('layouts.frontend.master', ['title' => trans("pages.{$type}")])

@section('content')
    <main class="py-4">
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <h3 class="page-title">{{ app_name() }}</h3>
                        <div class="row">
                            <nav class="nav flex-column">
                                <a class="nav-item nav-link" href="{{ route('pages.show', 'about') }}" title="عن لينكاتي">
                                    @lang('pages.about')
                                </a>
                                <a class="nav-item nav-link" href="{{ route('pages.show', 'privacy') }}" title="سياسة الخصوصية">
                                    @lang('pages.privacy')
                                </a>
                                <a class="nav-item nav-link" href="{{ route('pages.show', 'terms') }}" title="شروط الاستخدام">
                                    @lang('pages.terms')
                                </a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="page-content">
                            <h2>@lang("pages.{$type}")</h2>
                            {!! Settings::locale(app()->getLocale())->get($type, '') !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection