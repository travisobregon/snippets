@extends ('layouts.app')

@section ('content')
    <div class="col-md-10 col-md-offset-1">
        @forelse ($user->snippets as $snippet)
        	<article class="snippet">
                <div class="is-flex">
                    <h4 class="flex">
                        <a href="/snippets/{{ $snippet->id }}">
                            {{ $snippet->title }}
                        </a>

                        <small>By: {{ $user->name }}</small>
                    </h4>   

                    @include('snippets.like-form')
                </div>

                <pre><code>{{ $snippet->body }}</code></pre>
            </article>
        @empty
        	<h4 class="text-center">There are no snippets here at the moment.

            @if (Auth::user()->id === $user->id)
                <a href="/snippets/create">Create Snippet</a></h4>
            @endif
        @endforelse
    </div>
@endsection
