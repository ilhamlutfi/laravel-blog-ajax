@extends('layouts.app')

@section('title', 'Edit Article')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-card icon="list" title="Create Articles">
                    <form action="#" id="formUpdateArticle">
                        <input type="hidden" id="id" value="{{ $article->uuid }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" value="{{ $article->title }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="published">Status</label>
                                    <select name="published" id="published" class="form-select">
                                        <option value="1" {{ $article->published == 1 ? 'selected' : '' }}>Published</option>
                                        <option value="0" {{ $article->published == 0 ? 'selected' : '' }}>Draft</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-select select-single">
                                        <option value="" hidden>-- choose --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $article->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tag_id">Tag</label>
                                    <select name="tag_id[]" id="tag_id" class="form-select select-multi"
                                        data-placeholder="choose" multiple>
                                        <option value="" hidden>-- choose --</option>
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}"
                                                @if (in_array($tag->id, $article->tags->pluck('id')->toArray()))
                                                    selected
                                                @endif
                                                >{{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="content">Content</label>
                            <textarea name="content" id="content" cols="5" rows="5" class="form-control">{{ $article->content }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                                    <div class="mt-1">
                                        <img class="img-preview img-thumbnail" src="{{ asset('storage/images/'.$article->image)}}" width="200">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="keywords">Keywords</label>
                                    <input type="text" name="keywords" id="keywords" class="form-control" value="{{ $article->keywords }}">
                                </div>
                            </div>
                        </div>

                        <div class="float-end">
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary btnSubmit">Submit</button>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/backend/library/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src={{ asset('assets/backend/js/helper.js') }}></script>
    <script src={{ asset('assets/backend/js/article-editor.js') }}></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js') }}"></script>

    {!! JsValidator::formRequest('App\Http\Requests\ArticleRequest', '#formArticle') !!}
@endpush
