@extends("layout.master")

@section("content")

<div class="container">
    <div class="col-md-6 offset-3">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="foarm-group">
                <h2>add</h2>
            </div>
            <div class="form-group">
                @if(Session::get("message"))

                    <div class="alert alert-success">
                        {{ Session::get("message") }}
                    </div>
                @endif
            </div>
            <div>
            <div class="form-group">
                <label>name</label>
                <input type="text" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label>text</label>
                <textarea name="text" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="file"  class="form-control" name="image">
            </div>
            </div>
            <div class="form-group">
                <label>Post Tags</label>
                <select name="tags[]" id="" multiple>
                    @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <button type="submit" name="submit" class="btn btn-primary" >save data</button>
            </div>
        </form>
    </div>
</div>

@endsection
