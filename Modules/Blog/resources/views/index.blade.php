@extends('blog::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Blog Posts</span>
                <a href="{{ route('blog.create') }}" class="btn btn-primary">Create Blog</a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-bordered" id="blogs-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Detail</th>
                            <th>Author</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        var table = $('#blogs-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('blog.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'title', name: 'title'},
                {data: 'detail', name: 'detail'},
                {data: 'author', name: 'author'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            order: [[1, 'asc']]
        });
    });
</script>
@endsection
