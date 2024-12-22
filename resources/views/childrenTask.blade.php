@extends('layout.app')
@section('title', $task->title)
@section('content')
    <div class="mb-4">
        <a class="link" href="{{ route('tasks') }}">
            << Quay lại danh sách Task</a>
    </div>
    <p class="mb-2 text-slate-700">
        {{ $task->description }}
    </p>
    @isset($task->long_description)
        <p class="mb-2 text-slate-700">
            {{ $task->long_description }}
        </p>
    @endisset

    <p class="mb-2 text-slate-700">
        @if ($task->completed)
            <div class="font-medium text-green-500">
                Hoàn thành
            </div>
        @else
            <div class="font-medium text-red-500">
                Chưa hoàn thành
            </div>
        @endif
    </p>
    <p class="mb-2 text-slate-700">
        {{ $task->created_at->diffForHumans() }}
    </p>
    <p class="mb-2 text-slate-700">
        {{ $task->updated_at->diffForHumans() }}
    </p>
    <div class="mt-4 flex gap-2 items-center">
        <a class="btn" href="{{ route('edit.tasks', ['task' => $task]) }}">Sửa</a>
        <form action="{{ route('toggle-complete.tasks', ['task' => $task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button class="btn" type="submit">Đánh dấu {{ $task->completed ? 'hoàn thành' : 'chưa hoàn thành' }}
            </button>
        </form>
        <form action="{{ route('destroy.tasks', ['task' => $task]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Xóa</button>
        </form>
    </div>
@endsection
