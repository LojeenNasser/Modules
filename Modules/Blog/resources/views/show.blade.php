@extends('blog::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Show Blog Post</div>
            <div class="card-body">
                <div class="form-group">
                    <strong>Title:</strong>
                    {{ $blog->title }}
                </div>
                <div class="form-group">
                    <strong>Detail:</strong>
                    {{ $blog->detail }}
                </div>
                <div class="form-group">
                    <strong>Author:</strong>
                    {{ $blog->author }}
                </div>
                <a href="{{ route('blog.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
