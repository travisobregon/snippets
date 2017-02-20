@extends ('layouts.app')

@section ('content')
    <div class="col-md-8 col-md-offset-2">
        <h1>My Snippets</h1>

        @forelse ($user->snippets as $snippet)
        	<article class="snippet">
                <div class="is-flex">
                    <h4 class="flex">
                        <a href="/snippets/{{ $snippet->id }}">
                            {{ $snippet->title }}
                        </a>

                        <small>By: {{ $snippet->user->name }}</small>
                    </h4>   

                    <a href="/snippets/{{ $snippet->id }}/fork" class="btn btn-sm btn-default">Fork Me</a>
                </div>

                <pre><code>{{ $snippet->body }}</code></pre>
            </article>
        @empty
        	No snippets have been made yet. <a href="/snippets/create">Create Snippet</a>
        @endforelse
    </div>
@endsection
