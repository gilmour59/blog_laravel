@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('categories.create') }}" class="btn btn-success">Add</a>
    </div>
    <div class="card card-default">
        <div class="card-header">
            Categories
        </div>
        <div class="card-body">
            <table class="table table-borderless table-hover">
                <thead>
                    <th>Name</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                {{ $category->name }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm mr-3">Edit</a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $category->id }})">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <form action="" method="POST" id="deleteCategoryForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to Delete this Category?
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
            var form = document.getElementById('deleteCategoryForm');
            form.action = "categories/" + id;
            console.log(id, form);
        }
    </script>
@endsection
