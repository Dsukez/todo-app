<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスクを編集</title>
</head>
<body>
    <h1>タスクを編集</h1>

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">タイトル:</label>
            <input type="text" id="title" name="title" value="{{ $task->title }}" required>
        </div>
        <div>
            <label for="description">説明:</label>
            <textarea id="description" name="description">{{ $task->description }}</textarea>
        </div>
        <div>
            <label for="due_date">期限:</label>
            <input type="date" id="due_date" name="due_date" value="{{ $task->due_date }}">
        </div>
        <div>
            <label for="is_completed">完了:</label>
            <input type="checkbox" id="is_completed" name="is_completed" {{ $task->is_completed ? 'checked' : '' }}>
        </div>
        <button type="submit">更新する</button>
    </form>
</body>
</html>
