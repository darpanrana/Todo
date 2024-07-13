<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('verify_registeration') }}" >
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="name" placeholder="Enter Your Name">
                                @error('name')
                                    <label for="" class="text-danger"> {{ $message }} </label>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror " value="{{ old('email') }}" name="email" id="email" placeholder="Enter Your Email">
                                @error('email')
                                    <label for="" class="text-danger"> {{ $message }} </label>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pwd" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="pwd" placeholder="Enter Your Password">
                                @error('password')
                                    <label for="" class="text-danger"> {{ $message }} </label>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="cpwd" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="cpwd" placeholder="Enter Your Confirm Password">
                                @error('password_confirmation')
                                    <label for="" class="text-danger"> {{ $message }} </label>
                                @enderror
                            </div>
                            <button class="btn btn-primary w-100">Register</button>
                        </form>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <label class="pt-2" >Already Have An Account <a class="link-primary" href="{{ route('login') }}">Login</a></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html>
