@extends("layout.master")

@section("content")

<div class="container">
    <div class="col-md-6 offset-3">
        <form action="{{route('update', $post->id)}}" method="post">
            @method('PUT')
            <div class="foarm-group">
                <h2>Edit News</h2>
            </div>
            <div class="form-group">
                @if(Session::get("message"))
                    <div class="alert alert-success">
                        {{ Session::get("message") }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Post title</label>
                <input type="text" class="form-control" placeholder="title" name="title" value="{{old('title', $post->title)}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Post text</label>
                <input type="text" class="form-control" placeholder="text" name="text" value="{{old('text', $post->text)}}">
            </div>
            <div class="form-group">
                @csrf
                <input type="hidden" name="id">
                <button class="btn btn-info" name="submit">add</button>
            </div>
        </form>
    </div>
</div>

@endsection
