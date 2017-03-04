<form class="vote-form" method="POST">
    {{ csrf_field() }}

    <input type="hidden" name="snippet_id" value="{{ $snippet->id }}">

    <button class="glyphicon glyphicon-heart {{ Auth::user()->votedFor($snippet) ? 'liked' : '' }}" name="vote_btn"></button>
    
    <span class="vote-counter">{{ $snippet->votes->count() }}</span>

    <a href="/snippets/{{ $snippet->id }}/fork" class="btn btn-sm btn-default">Fork</a>
</form>