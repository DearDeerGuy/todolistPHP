@extends('layout')

@section('content')
<div class="outerdiv allowwrap">
    <form method="post" class="addform addlistform" action="addlist">
        @csrf
        <label>List name
            <input name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" required>
            @error('name')<p class="errormessage">{{$message}}</p>@enderror
        </label>
        <label>Date
            <input type="date" name="date" value="<?= isset($_POST['date']) ? $_POST['date'] : '' ?>" required>
            @error('date')<p class="errormessage">{{$message}}</p>@enderror
        </label>
        <button class="submitbtn">Add list</button>
    </form>
    @foreach($todolists as $list)
        <form method="get" class="todolist" action="details">
            @csrf
            <h1>{{$list['name']}}<br>{{$list['complete_date']}}</h1>
            @foreach($list->items as $item)
                <button class="littleitem {{$item->completed ? "completed" : ""}}">
                    <span>{{$item->name}}</span>
                    <span>{{$item->complete_time}}</span>
                </button>
            @endforeach
            <input name="id" value="{{$list['id']}}" hidden>
            <button class="submitbtn">Show more</button>
        </form>
    @endforeach
    @foreach($shared as $list)
        <form method="get" class="todolist" action="details">
            @csrf
            <h1>{{$list['name']}}<br>{{$list['complete_date']}}</h1>
            @foreach($list->items as $item)
                <button class="littleitem {{$item->completed ? "completed" : ""}}">
                    <span>{{$item->name}}</span>
                    <span>{{$item->complete_time}}</span>
                </button>
            @endforeach
            <input name="id" value="{{$list['id']}}" hidden>
            <button class="submitbtn">Show more</button>
        </form>
    @endforeach
</div>
@endsection
