@extends("layout.master")

@section("content")


<div class="container">
    <form method="post" class="col-md-6 offset-3 mt-4" action="{{ route('post_login') }}">

        @if (Session::has("status"))

        <div class="alert alert-danger">
            {{ Session::get("status") }}
        </div>

        @endif

        <div class="form-group">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>

            @csrf

            <div class="form-group">
                <button type="submit" class="btn btn-success">Logn</button>
            </div>

            <div class="form-group">
                <a href="/register">
                    register
                </a>
            </div>

        </div>
    </form>
</div>


@endsection
