@extends('layout')

@section('content')
    <div class="outerdiv">
        <form method="post" class="authform">
            @csrf
            <label>Name
                <input name="name" type="text" value="{{old('name', '')}}" required>
                @error('name')<p class="errormessage">{{$message}}</p>@enderror
            </label>

            <label>Email
                <input name="email" type="email" value="{{old('email', '')}}" required>
                @error('email')<p class="errormessage">{{$message}}</p>@enderror
            </label>

            <label>Password
                <input name="password" type="password" value="" required>
                @error('password')<p class="errormessage">{{$message}}</p>@enderror
            </label>

            <label>Repeat password
                <input name="password_confirmation" type="password" value="" required>
            </label>

            <button type="submit" class="submitbtn">Register</button>
        </form>
    </div>
@endsection
