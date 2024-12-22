@extends('layout.app')
@section('title', isset($task) ? 'Sửa Task ' . $task->title : 'Tạo Task')
@section('content')
    <form action="{{ isset($task) ? route('update.tasks', ['task' => $task->id]) : route('store.tasks') }}" method="post">
        @csrf
        @isset($task)
            @method('PUT')
        @else
            @method('POST')
        @endisset
        <div class="mb-4">
            <label for="title">Title</label>
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
            <input @class(['border border-red-500' => $errors->has('title')]) type="text" name="title" id="title"
                value="{{ $task->title ?? old('title') }}">
        </div>
        <div class="mb-4">
            <label for="description">Description</label>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror
            <textarea @class(['border border-red-500' => $errors->has('description')]) type="text" name="description" id="description" rows="5">{{ $task->description ?? old('description') }}</textarea>
        </div>
        <div class="mb-4">
            <label for="long_description">Long Description</label>
            @error('long_description')
                <p class="error">{{ $message }}</p>
            @enderror
            <textarea @class(['border border-red-500' => $errors->has('long_description')]) type="text" name="long_description" id="long_description" rows="10">{{ $task->long_description ?? old('long_description') }}</textarea>
        </div>
        <div class="mb-4 flex justify-center">
            <button class="btn" type="submit">
                @isset($task)
                    Sửa Task
                @else
                    Thêm Task
                @endisset
            </button>
        </div>
    </form>
@endsection
