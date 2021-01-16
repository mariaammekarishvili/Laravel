@extends("layout.master")

@section("content")

	<div class="container">

		@foreach($posts as $post)

        <div class="mt-8 bg-blue dark:bg-red-800 overflow-hidden shadow mt-3 p-2 sm:rounded-lg post">
            <div class="grid grid-cols-1 md:grid-cols-1">

                <div class="p-6 border-t border-red-200 dark:border-red-700">
                    <div class="ml-12">
                        <div class="mt-2 text-red-600 dark:text-red-400 text-sm">
                            <a href="{{route('show_post', $post->id)}}">
                                <img src="/uploads/posts/{{$post->image}}"><br>
                            </a>

                            {{ $post->text }}
                            <div class="ml-12">
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tag', $tag->id)}}">
                                        {{$tag->name}}
                                    </a>
                                @endforeach
                            </div>
                            <p>Author: {{ $post->user->name }}</p>
                                @can('approve', $post)

                                @if($post->is_approves)
                                    <button type="submit" class="fa fa-check btn-approved" url="{{route('approve',$post->id)}}"></button>
                                @else
                                    <button type="submit" class="fa fa-thumbs-up btn-approve" url="{{route('approve',$post->id)}}"></button>
                                @endif
                                    <button type="submit" class="fa fa-trash btn-delete" url="{{route('del', $post->id)}}" ></button>
                                    <a href="{{route('edit', $post->id)}}" >edit</a>
                                @endcan
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @endforeach
    </div>
    <script type="text/javascript">
        $(document).ready(function (){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.btn-delete', function (e){
                e.preventDefault();
                $this=$(this);
                $.ajax({
                    type: 'DELETE',
                    url: $this.attr('url'),
                    success: function (){
                        $this.closest('.post').remove()
                    }
                });
            });

            $(document).on('click', '.btn-approve', function (e){
                e.preventDefault();
                $this=$(this);
                $.ajax({
                    type: 'POST',
                    url: $this.attr('url'),
                    success: function (){
                        $this.removeClass('fa-thumbs-up');
                        $this.addClass('fa-check');
                    }
                });
            });

            $(document).on('click', '.btn-approved', function (e){
                e.preventDefault();
                $this=$(this);
                $.ajax({
                    type: 'POST',
                    url: $this.attr('url'),
                    success: function (){
                        $this.removeClass('fa-check');
                        $this.addClass('fa-thumbs-up');
                    }
                });
            });
        });

    </script>


@endsection
