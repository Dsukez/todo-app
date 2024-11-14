<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク一覧</title>
</head>
<body>
    <h1>タスク一覧</h1>

    <a href="/tasks/create">新しいタスクを追加</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>タイトル</th>
            <th>説明</th>
            <th>完了状況</th>
            <th>期限</th>
            <th>操作</th>
        </tr>
        @foreach ($tasks as $task)
        <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->is_completed ? '完了' : '未完了' }}</td>
            <td>{{ $task->due_date }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task->id) }}">編集</a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</body>
</html>
