<form action="{{ $action }}" method="post">
    @csrf
    @method($method)

    @if ($errors->isNotEmpty())
        <div id="error_explanation">
            <h2>{{ $errors->count() }} prohibited this task from being saved:</h2>

            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <p>
        <label for="title">タイトル</label>
        <br>
        <input id="title" class="field" type="text" name="title" value="{{ old('title', $task->title ?? '') }}">
    </p>

    <p>
        <label for="content">内容</label>
        <br>
        <textarea id="content" class="field" name="content" cols="30"
                  rows="10">{{ old('content', $task->content ?? '') }}</textarea>
    </p>

     <button>{{ $submit }}</button>
</form>
