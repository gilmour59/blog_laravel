@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('tags.create') }}" class="btn btn-success">Add</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Tags
        </div>
        <div class="card-body">
            @if ($tags->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <th>Name</th>
                        <th>Post Count</th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>
                                    {{ $tag->name }}
                                </td>
                                <td>
                                    {{ $tag->posts->count() }}
                                </td>
                                <td>
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info btn-sm mr-3">Edit</a>
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $tag->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h5 class="text-center">No Tags Yet!</h5>
            @endif
            <form action="" method="POST" id="deleteTagForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="font-weight-bold">
                                    Are you sure you want to delete this Tag?
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back!</button>
                                <button type="submit" class="btn btn-danger">Delete!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {
            $('#deleteModal').modal('show');
            var form = document.getElementById('deleteTagForm');
            form.action = "tags/" + id;
            console.log(id, form);
        }
    </script>
@endsection
