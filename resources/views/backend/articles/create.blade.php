@extends('layouts.app')

@section('title', 'Create Article')

@push('css')
@endpush

@push('js')
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card icon="list" title="Create Articles">
                    <h1>OK</h1>
                </x-card>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/category.js') }}></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\CategoryRequest', '#formCategory') !!}
@endpush
