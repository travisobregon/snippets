<favourite snippet-id="{{ $snippet->id }}" :initial-favourited="{{ json_encode(Auth::user()->votedFor($snippet)) }}" initial-count="{{ $snippet->votes->count() }}" ></favourite>

<a href="/snippets/{{ $snippet->id }}/fork" class="btn btn-sm btn-default" style="display: inline-table">Fork</a>
