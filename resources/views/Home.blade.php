<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <title>Home</title>
</head>
<body class="bg-body-secondary">
    <div class="container">
        <nav class="text-center pt-3">
            <div class="row">
                <div class="col-12 col-md-2 d-flex justify-content-center align-items-center">
                    <label class="text-primary">Hello, {{ Auth::user()->name }}</label>
                </div>
                <div class="col-12 col-md-8">
                    <label class="text-success fs-1 fw-bold">Todo List</label>
                </div>
                <div class="col-12 col-md-2 d-flex justify-content-md-end justify-content-center align-items-center">
                    <a href="{{ url('/logout') }}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </nav>
        
        <section class="pt-3">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card">
                        <form action="{{ route('add_task') }}" method="POST">
                            @csrf
                            <div class="row p-2">
                                <div class="col-10">
                                    <div class="form-group">
                                        <input type="text" placeholder="Add Task" class="form-control @error('task') is-invalid @enderror" name="task" id="task" aria-describedby="helpId">
                                        @error('task')
                                            <label class="text-danger"> {{ $message }} </label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-2">
                                    <button class="btn btn-success">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if ($is_Empty)
                        <div class="row mt-4">
                            <div class="col rounded text-center p-2 text-bg-light">
                                There Are No Tasks
                            </div>
                        </div>
                    @else
                        <table class="table rounded-3 overflow-hidden mt-3">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Update</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taske as $item)
                                <tr>
                                    <td>
                                        <form id="checkbox-form-{{ $item->id }}" action="{{ url('/task_done',$item->id) }}" method="post">
                                            @csrf
                                            <input id="my-input-{{ $item->id }}" class="form-check-input fs-5" type="checkbox" name="checkbox_value" value="done" @if($item->status == 'done') checked @endif />
                                        </form>
                                    </td>
                                    <td class="fs-5">{{ $item->task }}</td>
                                    <td>
                                        @if($item->status == 'done')
                                            <label class="bg-success text-white rounded p-1">{{ $item->status }}</label>
                                        @else
                                            <label class="text-white bg-danger rounded p-1">{{ $item->status }}</label>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $item->id }}">Edit</button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel{{ $item->id }}">Update Task</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ url('/edit_task', $item->id) }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="task{{ $item->id }}">Enter Task</label>
                                                                <input type="text" value="{{ $item->task }}" class="form-control @error('task') is-invalid @enderror" name="task" id="task{{ $item->id }}" placeholder="Enter Task" required>
                                                                @error('task')
                                                                    <label class="text-danger"> {{ $message }} </label>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                    <td>
                                        <form action="{{ url('task_delete',$item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <script>
                                    document.getElementById('my-input-{{ $item->id }}').addEventListener('change', function() {
                                        document.getElementById('checkbox-form-{{ $item->id }}').submit();
                                    });
                                </script>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>