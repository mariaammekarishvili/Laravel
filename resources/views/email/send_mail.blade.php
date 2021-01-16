@extends("layout.master")

@section("content")
<div class="container">
    <div class="col-md-6 offset-3">
        <form method="post" action="{{route('send')}}">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="mail" class="form-control">
            </div>
            <div class="form-group">
                @csrf
                <button class="btn btn-info" name="submit">send</button>
            </div>
        </form>
    </div>
</div>
@endsection
