@extends('blog::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Create Blog Post</div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('blog.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" name="title" class="form-control" placeholder="Enter Title">
                    </div>

                    <div class="form-group">
                        <label for="detail">Detail:</label>
                        <textarea name="detail" class="form-control" placeholder="Enter Detail"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="author">Author:</label>
                        <input type="text" name="author" class="form-control" placeholder="Enter Author Name">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
