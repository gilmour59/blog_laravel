@extends('layouts.app')

@section('content')

    @if(!isset($trash))
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('posts.create') }}" class="btn btn-success">Add</a>
        </div>
    @endif

    <div class="card card-default">
        <div class="card-header">
            {{ isset($trash) ? 'Trashed Posts' : 'Posts' }}
        </div>
        <div class="card-body">
            @if ($posts->count() > 0)
                <table class="table table-hover">
                    <thead>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $post->image) }}" alt=" {{ $post->title }}" width="40" height="40">
                                </td>
                                <td>
                                    {{ $post->title }}
                                </td>
                                <td>
                                    {{ $post->category->name }}
                                </td>
                                <td>
                                    @if ($post->trashed())
                                        <form action="{{ route('posts.restore', $post->id) }}" method="POST" id="restoreForm">
                                            @csrf
                                            @method('PUT')
                                        </form>
                                        <button type="submit" form="restoreForm" class="btn btn-info btn-sm mr-3">Restore</button>
                                    @else
                                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm mr-3">Edit</a>
                                    @endif
                                    <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $post->id }}, {{ $post->trashed() }})">
                                        {{ $post->trashed() ? 'Delete' : 'Trash'}}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(isset($trash))
                <h5 class="text-center">Empty!</h5>
            @else
                <h5 class="text-center">No Posts Yet!</h5>
            @endif
            <form action="" method="POST" id="deletePostForm">
                @csrf
                @method('DELETE')
                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel"></h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="font-weight-bold" id="deleteP"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go Back!</button>
                                <button type="submit" class="btn btn-danger" id="deleteButton"></button>
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
        function handleDelete(id, trash) {
            $('#deleteModal').modal('show');
            var form = document.getElementById('deletePostForm');

            if(trash){
                form.action = "trashed-posts/" + id;
            }else{
                form.action = "posts/" + id;
            }  
            console.log(trash, id, form);

            if(trash == true){
                $('#deleteModalLabel').html('Delete Post');
                $('#deleteP').html('Are you sure you want to delete this Post?');
                $('#deleteButton').html('Delete');
            }else{
                $('#deleteModalLabel').html('Trash Post');
                $('#deleteP').html('Are you sure you want to trash this Post?');
                $('#deleteButton').html('Trash');
            }
        }
    </script>
@endsection
