@extends('layout')

@section('content')
    <div class="outerdiv columndiv">
        <form class="addform" method="post"  action="additem" >
            @csrf
            <input name="id" value="{{$list['id']}}" hidden>

            <label>Name
                <input name="name" value="{{old('name')}}">
            </label>

            <label>Complete time
                <input type="time" name="completetime" value="{{old('completetime')}}">
            </label>

            <button class="submitbtn">Add item</button>
        </form>
        <div class="addform">
            <h1>{{$list['name']}}<br>{{$list['complete_date']}}</h1>
            <div>
                @error('id')<p class="errormessage">{{$message}}</p>@enderror
                @error('item_id')<p class="errormessage">{{$message}}</p>@enderror
            </div>
            @foreach($list->items as $item)
                <div class="item">
                    <form method="post" action="makechecked" class="smallitem">
                        @csrf
                        <input name="id" value="{{$list['id']}}" hidden>
                        <input name="item_id" value="{{$item['id']}}" hidden>
                        <button class="littleitem {{$item->completed ? "completed" : ""}} hovering">
                            <span>{{$item->name}}</span>
                            <span>{{$item->complete_time}}</span>
                        </button>
                    </form>
                    <form method="post" class="deletebtn" action="deleteitem">
                        @csrf
                        <input name="id" value="{{$list['id']}}" hidden>
                        <input name="item_id" value="{{$item['id']}}" hidden>
                        <button class="submitbtn">X</button>
                    </form>
                </div>
            @endforeach
            @if($list['user_id'] == Auth::id())
                <form method="post" class="item" action="sharelist">
                    @csrf
                    <input name="id" value="{{$list['id']}}" hidden>
                    <select name="user_id">
                        @foreach($userstoadd as $add)
                            <option value="{{$add['id']}}">{{$add['name']}}({{$add['email']}})</option>
                        @endforeach
                    </select>
                    <button class="submitbtn">Add user</button>
                    @error('id')<p class="errormessage">{{$message}}</p>@enderror
                    @error('user_id')<p class="errormessage">{{$message}}</p>@enderror
                    @error('error')<p class="errormessage">{{$message}}</p>@enderror
                </form>
                <h3>Already added users:</h3>
                @foreach($existusers as $exist)
                    <p>{{$exist['name']}}({{$exist['email']}})</p>
                @endforeach
            @endif
        </div>
    </div>

@endsection
