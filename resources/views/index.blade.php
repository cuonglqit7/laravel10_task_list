@extends('layout.app')
@section('title', 'Task List')
@section('content')
    <div class="mb-4">
        <a class="link" href="{{ route('create.tasks') }}">
            <Button>Thêm Task</Button>
        </a>
    </div>

    @if (isset($tasks) && count($tasks) > 0)
        @foreach ($tasks as $task)
            <p>
                <a href="{{ route('children.tasks', ['task' => $task->id]) }}" @class(['line-through' => $task->completed])>
                    {{ $task->title }}
                </a>
            </p>
        @endforeach
        <nav class="mt-4">
            {{ $tasks->links() }}
        </nav>
    @else
        <p>Không có task nào</p>
    @endif
@endsection
