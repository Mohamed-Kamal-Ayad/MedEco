@extends('layouts.frontend.master', ['title' => trans('dashboard.home')])

@section('content')
    <main class="p-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-3 mb-lg-0">
                    <div class="card p-2 p-md-3 p-lg-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" class="img-h50 rounded-circle mr-3">
                            <div>
                                <div class="d-flex flex-wrap align-items-center">
                                    <div class="m-0 font-14 font-weight-bold mr-3">
                                        <i class="far fa-user mr-2"></i>
                                        {{ auth()->user()->name }}
                                    </div>
                                    <div class="m-0 font-14 font-weight-light">
                                        <i class="fa fa-phone mr-2"></i>
                                        {{ auth()->user()->phone }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
