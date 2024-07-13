<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('/home') }}" class="btn btn-success">Back</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Add Task</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('add_task') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="task" class="form-label">Task</label>
                                <input type="text" name="taske" class="form-control @error('taske') is-invalid @enderror" id="task" placeholder="Enter Task">
                                @error('taske')
                                    <label class="text-danger"> {{ $message }} </label>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
