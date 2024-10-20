@extends('layouts.app')

@section('title', 'Article: ' . $article->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <x-card icon="file-alt" title="Detail Article: {!! $article->title !!}">

                    <div class="table-responsive-sm">
                        <table class="table table-striped table-bordered table-striped" id="yajra" width="100%">
                            <tr>
                                <th>Title</th>
                                <td>{{ $article->title }}</td>
                            </tr>

                            <tr>
                                <th>Slug</th>
                                <td>{{ $article->slug }}</td>
                            </tr>

                            <tr>
                                <th>Category</th>
                                <td>{{ $article->category->name }}</td>
                            </tr>

                            <tr>
                                <th>Tag</th>
                                <td>
                                    @foreach ($article->tags as $tag)
                                        <span class="badge bg-secondary">{{ $tag->name }}</span> <span class="mx-1"></span>
                                    @endforeach
                                </td>
                            </tr>

                            <tr>
                                <th>Content</th>
                                <td>{{ $article->content }}</td>
                            </tr>

                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($article->published == 1)
                                        <span class="badge bg-success">Published</span>
                                    @else
                                        <span class="badge bg-danger">Draft</span>
                                    @endif
                                </td>
                            </tr>

                            @if ($article->published_at)
                                <tr>
                                    <th>Published At</th>
                                    <td>{{ date('d-m-Y', strtotime($article->published_at)) }}</td>
                                </tr>
                            @endif

                            <tr>
                                <th>Views</th>
                                <td>{{ $article->views }}</td>
                            </tr>

                            <tr>
                                <th>Keywords</th>
                                <td>{{ $article->keywords }}</td>
                            </tr>

                            <tr>
                                <th>Image</th>
                                <td>
                                    <a href="{{ asset('storage/images/' . $article->image) }}" target="_blank"
                                        rel="noopener noreferrer">
                                        <img src="{{ asset('storage/images/' . $article->image) }}" width="200">
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <div class="float-end">
                            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                            <a href="{{ route('admin.articles.edit', $article->uuid) }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    </div>

                </x-card>
            </div>
        </div>
    </div>
@endsection
