@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li class="list-group text-danger">
                {{ $error }}
            </li>
        @endforeach
    </div>
@endif
