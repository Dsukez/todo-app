<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新しいタスクを追加</title>
</head>
<body>
    <h1>新しいタスクを追加</h1>

    <form action="/tasks" method="POST">
        @csrf
        <div>
            <label for="title">タイトル:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="description">説明:</label>
            <textarea id="description" name="description"></textarea>
        </div>
        <div>
            <label for="due_date">期限:</label>
            <input type="date" id="due_date" name="due_date">
        </div>
        <button type="submit">タスクを追加</button>
    </form>
</body>
</html>
