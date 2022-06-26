<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style>
        tr {
            vertical-align: middle;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-warning">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Task Manager</span>
        </div>
    </nav>
    <main>
        <div class="container bg-light rounded mt-3 p-1">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tasks</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">End Time</th>
                        <th scope="col">Total time</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <form method="POST" action="{{ url('/reschedule') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $task->id }}"> 
                            <th scope="row">{{ $task->id }}</th>
                            <td>{{ $task->task_name }}</td>
                            <td>
                                <div class="mb-3">
                                    <label for="start" class="form-label"></label>
                                    <input type="text" class="form-control" id="start" name="start" value="{{ Carbon\Carbon::parse($task->start_time)->format('h:i:s A') }}">
                                </div>
                            </td>
                            <td>
                                <div class="mb-3">
                                    <label for="end" class="form-label"></label>
                                    <input type="text" class="form-control" id="end" name="end" value="{{ Carbon\Carbon::parse($task->end_time)->format('h:i:s A') }}">
                                </div>
                            </td>
                            <td>{{ $task->total_time }}</td>
                            <td>
                                <button type="submit" class="btn btn-warning">Update</button>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>