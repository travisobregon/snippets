@extends ('layouts.app')

@section ('content')
    <article class="snippet">
        <div class="is-flex">
            <h4 class="flex">
                {{ $snippet->title }}

                <small>By: {{ $snippet->user->name }}</small>
            </h4>   

            @include('snippets.like-form')
        </div>

        <pre><code>{{ $snippet->body }}</code></pre>
    </article>

    <p>
        <a href="/">Back</a>
    </p>

    @if ($snippet->isAFork())
        <hr>
        
        <h4>
            Forked From 
            <a href="/snippets/{{ $snippet->originalSnippet->id }}">
                {{ $snippet->originalSnippet->title }}
            </a>
        </h4>
    @endif

    @if ($snippet->forks->count())
        <hr>

        <h4>Forks</h4>

        <ul class="list-group">
            @foreach ($snippet->forks as $fork)
                <li class="list-group-item">
                    <a href="/snippets/{{ $fork->id }}">
                        {{ $fork->title }}
                    </a>

                    <small>By: {{ $fork->user->name }}</small>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
