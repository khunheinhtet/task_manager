<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <a href="/">
            <button class="btn btn-success mt-3 mb-3">Back</button>
        </a>
        <form action="/update/{{$data->id}}" method="post">
            <!-- @method ('put') -->
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $data->title) }}" required>

                    <!-- <input type="text" class="form-control" id="title" name="title" value="{{ old('title')? old('title'): $data->title }}" required> -->
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $data->description) }}" required>
                    <!-- <textarea class="form-control" id="description" rows="3" name="description">{{ old('description') }}</textarea> -->
                </div>

                <div class="mb-3">
                    <label for="priority" class="form-label">Priority</label>
                    <select name="priority" id="priority" class="form-select" required>
                        <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="Pending" {{ old('status') == 'Completed' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ old('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>
            <button type="submit" class='btn btn-success'>Submit</button>
        </form>
    </div>
</body>
</html>