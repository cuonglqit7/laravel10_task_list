<?php

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// class Task
// {
//     public function __construct(
//         public int $id,
//         public string $title,
//         public string $description,
//         public ?string $long_description,
//         public bool $completed,
//         public string $created_at,
//         public string $updated_at
//     ) {}
// }

// $tasks = [
//     new Task(
//         1,
//         'Đi chợ',
//         'Task 1 description',
//         'Task 1 long description',
//         false,
//         '2023-03-01 12:00:00',
//         '2023-03-01 12:00:00'
//     ),
//     new Task(
//         2,
//         'Bán hàng online',
//         'Task 2 description',
//         null,
//         false,
//         '2023-03-02 12:00:00',
//         '2023-03-02 12:00:00'
//     ),
//     new Task(
//         3,
//         'Học lập trình',
//         'Task 3 description',
//         'Task 3 long description',
//         true,
//         '2023-03-03 12:00:00',
//         '2023-03-03 12:00:00'
//     ),
//     new Task(
//         4,
//         'Đi bộ',
//         'Task 4 description',
//         null,
//         false,
//         '2023-03-04 12:00:00',
//         '2023-03-04 12:00:00'
//     ),
// ];

Route::get('/', function () {
    $tasks = Task::latest()->paginate(8);
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('tasks');
Route::get('/tasks', function () {
    $tasks = Task::latest()->paginate(8);
    return view('index', [
        'tasks' => $tasks
    ]);
})->name('index.tasks');


Route::view('/tasks/create', 'create')->name('create.tasks');
Route::post('/tasks', function (TaskRequest $request) {
    $task = Task::create($request->validated());

    return redirect()->route('children.tasks', ['task' => $task])->with('success', 'Đã tạo task thành công!');
})->name('store.tasks');

Route::get('/tasks/{task}', function (Task $task) {
    if (!$task) {
        abort(response::HTTP_NOT_FOUND);
    }
    return view('childrenTask', ['task' => $task]);
})->name('children.tasks');

Route::get('/tasks/{task}/edit', function (Task $task) {
    if (!$task) {
        abort(response::HTTP_NOT_FOUND);
    }
    return view('edit', ['task' => $task]);
})->name('edit.tasks');

Route::put('/tasks/{task}', function (TaskRequest $request, Task $task) {
    $task->update($request->validated());

    return redirect()->route('children.tasks', ['task' => $task])->with('success', 'Đã sửa task thành công!');
})->name('update.tasks');

Route::delete('/tasks/{task}', function (Task $task) {
    $task->delete();
    return redirect()->route('tasks')->with('success', 'Đã xóa task thành công!');
})->name('destroy.tasks');

Route::put('/tasks/{task}/toggle-complete', function (Task $task) {
    $task->toggleComplete();
    return redirect()->back()->with('success', 'Đã cập nhật thành công!');
})->name('toggle-complete.tasks');
