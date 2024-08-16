@extends('book::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">Book Details</div>
            <div class="card-body">
                <h2>{{ $book->book_name }}</h2>
                <p><strong>Price:</strong> ${{ $book->price }}</p>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Description:</strong> {{ $book->description }}</p>
                <a href="{{ route('book.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
