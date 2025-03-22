<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="new">
            <button class="btn btn-success mt-3 mb-3">New</button>
        </a>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">description</th>
                <th scope="col">priority</th>
                <th scope="col">status</th>
                <th scope="col">due_date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index=>$value)
                <tr>
                    <th >{{$index+1}}</th>
                    <td>{{$value->title}}</td>
                    <td>{{$value->description}}</td>
                    <td style="background-color: 
                        {{ $value->priority == 'Low' ? 'green' : ($value->priority == 'Medium' ? 'yellow' : 'red') }}; 
                        text-align: center;">
                        {{ $value->priority }}
                    </td>
                    <td>{{$value->status}}</td>
                    <td>{{$value->due_date}}</td>
                    <td>
                        <a href="edit/{{$value->id}}" style='text-decoration:none; color:unset'>
                            <button class="btn btn-secondary">Edit</button>
                        </a>
                        <a href="delete/{{$value->id}}" style='text-decoration:none; color:unset'>
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>