@extends ('layouts.app')

@section ('content')
    @if ($snippets->count())
        <div class="text-center mb-1">
            <a class="btn btn-primary" href="/snippets/create">Create Snippet</a>
        </div>
        
        <div class="snippets">
                @foreach ($snippets as $snippet)
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
                @endforeach
        </div>

        <div class="text-center">
            {{ $snippets->links() }}
        </div>
    @else
        <div class="text-center">
            <h1 class="mb-1">There are no snippets at the moment. Make the first!</h1>

            <a class="btn btn-lg btn-primary" href="/snippets/create">Create Snippet</a>
        </div>
    @endif
@endsection
