<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <div class="inner_width">
            <div class="login_item">
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form_gp mt-3">
                        <label for="email" class="label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" class="text_box" value="{{ old('email') }}">
                        @error('email') <span class="error">{{ $message }}</span><br> @enderror
                    </div>
                    <div class="form_gp mt-3">
                        <label for="password" class="label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" class="text_box" value="{{ old('password') }}">
                        @error('password') <span class="error">{{ $message }}</span><br> @enderror
                    </div>
                    <div class="submit_item mt-3">
                        <button class="btn btn-primary" type="submit">{{ __('login') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>