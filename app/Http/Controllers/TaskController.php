<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // フィルタリング処理
        if ($request->filter === 'completed') {
            $query->where('is_completed', true);
        } elseif ($request->filter === 'incomplete') {
            $query->where('is_completed', false);
        }

        $tasks = $query->get();

        // タスク一覧を表示
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        // タスク作成ページを表示
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // 新しいタスクを作成
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_completed' => false, // 新しいタスクは未完了
        ]);

        // タスク一覧ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('tasks.index')->with('success', 'タスクを追加しました。');
    }

    public function edit(Task $task)
    {
        // タスク編集ページを表示
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
        ]);

        // タスクを更新
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'is_completed' => $request->has('is_completed'), // チェックボックスで完了状況を更新
        ]);

        // タスク一覧ページにリダイレクトし、更新メッセージを表示
        return redirect()->route('tasks.index')->with('success', 'タスクを更新しました。');
    }

    public function destroy(Task $task)
    {
        // タスクを削除
        $task->delete();

        // タスク一覧ページにリダイレクトし、削除メッセージを表示
        return redirect()->route('tasks.index')->with('success', 'タスクを削除しました。');
    }

    public function bulkDelete(Request $request)
    {
        // 選択されたタスクIDを取得
        $taskIds = $request->input('tasks', []);

        // 選択されたタスクを一括削除
        Task::whereIn('id', $taskIds)->delete();

        // タスク一覧ページにリダイレクトし、メッセージを表示
        return redirect()->route('tasks.index')->with('success', '選択したタスクを削除しました。');
    }
}
