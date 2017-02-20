@extends ('layouts.app')

@section ('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Create Snippet</div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/snippets">
                    {{ csrf_field() }}

                    @if ($snippet->id)
                        <input type="hidden" name="forked_id" value="{{ $snippet->id }}">
                    @endif

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Title</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $snippet->title) }}" required autofocus>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                        <label for="body" class="col-md-4 control-label">Body</label>

                        <div class="col-md-6">
                            <textarea id="body" name="body" class="form-control" required>{{ old('body', $snippet->body) }}</textarea>

                            @if ($errors->has('body'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('body') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push ('scripts')
        <script>
            document.querySelector('#body').addEventListener('keydown', function(e) {
                if (e.keyCode === 9) { // tab was pressed
                    // get caret position/selection
                    let val = this.value,
                        start = this.selectionStart,
                        end = this.selectionEnd;

                    // set textarea value to: text before caret + tab + text after caret
                    this.value = val.substring(0, start) + '\t' + val.substring(end);

                    // put caret at right position again
                    this.selectionStart = this.selectionEnd = start + 1;

                    e.preventDefault();
                }
            });
        </script>
    @endpush
@endsection
