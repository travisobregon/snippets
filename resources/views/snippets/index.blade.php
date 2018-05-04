@extends ('layouts.app')

@section ('content')
    @if ($snippets->count())        
        <div class="row">
            <div class="col-md-8">
                <div class="snippets">
                    @foreach ($snippets as $snippet)
                        <article class="snippet">
                            <div class="is-flex">
                                <h4 class="flex">
                                    <a href="/snippets/{{ $snippet->id }}">
                                        {{ $snippet->title }}
                                    </a>

                                    <small>By: <a href="/&#64;{{ $snippet->user->username }}">{{ $snippet->user->name }}</a></small>
                                </h4>   

                                @include('snippets.vote-form')
                            </div>

                            <pre><code>{{ $snippet->body }}</code></pre>
                        </article>
                    @endforeach
                </div>

                <div class="text-center">
                    {{ $snippets->links() }}
                </div>
            </div>

            <div class="col-md-4">
                <top-users :initial-top-users="{{ json_encode($topUsers) }}"><top-users>
            </div>
        </div>
    @else
        <h4 class="text-center">There are no snippets at the moment. <a class="" href="/snippets/create">Create Snippet</a></h4>
    @endif
@endsection
