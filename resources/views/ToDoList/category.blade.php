@extends('layout')

@section('content')
    <div class="outerdiv columndiv">
        <form class="addform" method="post" action="addcategory">
            @csrf
            <label>Category name
                <input name="category" value="{{old('$category')}}" required>
                @error('category')<p class="errormessage">{{$message}}</p>@enderror
                @error('error')<p class="errormessage">{{$message}}</p>@enderror
            </label>
            <button class="submitbtn">Add category</button>
        </form>
        <div class="categoryitems">
            <h1 style="text-align: center">CATEGORIES</h1>
            @error('editerror')<p class="errormessage">{{$message}}</p>@enderror
            @foreach($categories as $category)
                <form class="categoryitem" method="post" action="editcategory">
                    @csrf
                    <input name="id" value="{{$category['id']}}" hidden>
                    <input name="category" value="{{$category['name']}}" required>
                    <button class="submitbtn">Edit</button>
                    @if(old('id') == $category['id'])
                        @error('id')<p class="errormessage">{{$message}}</p>@enderror
                        @error('category')<p class="errormessage">{{$message}}</p>@enderror
                    @endif
                </form>
            @endforeach
        </div>
    </div>
@endsection
