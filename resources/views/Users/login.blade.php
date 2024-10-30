@extends('layout')

@section('content')
    <div class="outerdiv">
        <form method="post" class="authform">
            @csrf
            <label>Email
                <input name="email" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required>
                @error('email')<p class="errormessage">{{$message}}</p>@enderror
            </label>

            <label>Password
                <input name="password" type="password" required>
                @error('password')<p class="errormessage">{{$message}}</p>@enderror
                @error('autherror')<p class="errormessage">{{$message}}</p>@enderror
            </label>

            <button type="submit" class="submitbtn">Login</button>
        </form>
    </div>
@endsection
