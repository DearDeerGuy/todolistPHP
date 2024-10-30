<?php

namespace App\Http\Controllers;

use App\Models\SharedWith;
use App\Models\ToDoItem;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
{
    // GET for main
    public function main() {
        $todolists = User::find(Auth::id())->lists;
        $shared = ToDoList::whereIn('id', SharedWith::where("user_id", Auth::id())->pluck("todolist_id"))->get();
        return view('ToDoList/main', ['todolists' => $todolists, 'shared' => $shared]);
    }
    // POST for addList
    public function addList(Request $request) {
        $data = $request->validate(['name' => ['required', 'string', 'max:255'], 'date' => ['required', 'date']]);

        $list = new ToDoList();
        $list->user_id = Auth::id();
        $list->name = $data['name'];
        $list->complete_date = $data['date'];
        $list->save();

        return redirect('/main');
    }
    public function details(Request $request) {
        $data = $request->validate(['id' => ['required', 'integer', 'exists:todolists,id']]);

        $todolist = ToDoList::find($data['id']);
        if(!count($todolist->where('user_id', Auth::id())->where('id', $data['id'])->get()) && !count(SharedWith::where('user_id', Auth::id())->where('todolist_id', $data['id'])->get()))
            return redirect('/main')->withErrors(['error' => 'You do not have permission to view this list.']);

        $userstoadd = User::whereNotIn('id', SharedWith::where("todolist_id", $data['id'])->pluck('user_id'))->whereNot('id', Auth::id())->get();
        $existusers = User::whereIn('id', SharedWith::where('todolist_id', $data['id'])->pluck('user_id'))->get();

        return view('ToDoList/details', ['list' => $todolist, 'userstoadd' => $userstoadd, 'existusers' => $existusers]);
    }
    public function makeChecked(Request $request) {
        $data = $request->validate(['id' => ['required', 'integer', 'exists:todolists,id'], 'item_id' => ['required', 'integer', 'exists:todoitems,id']]);

        $todolist = ToDoList::find($data['id']);
        if(!count($todolist->where('user_id', Auth::id())->where('id', $data['id'])->get()) && !count(SharedWith::where('user_id', Auth::id())->where('todolist_id', $data['id'])->get()))
            return redirect('/main')->withErrors(['error' => 'You do not have permission to view this list.']);

        $todoitem = ToDoItem::where('id', $data['item_id'])->first();
        $todoitem->completed = !$todoitem->completed;
        $todoitem->save();
        return back();
    }
    public function addItem(Request $request) {
        $data = $request->validate(['id' => ['required', 'integer', 'exists:todolists,id'], 'name' => ['required', 'string'], 'completetime' => ['required', 'date_format:H:i']]);

        $todolist = ToDoList::find($data['id']);
        if(!count($todolist->where('user_id', Auth::id())->where('id', $data['id'])->get()) && !count(SharedWith::where('user_id', Auth::id())->where('todolist_id', $data['id'])->get()))
            return redirect('/main')->withErrors(['error' => 'You do not have permission to view this list.']);

        $item = new ToDoItem();
        $item->name = $data['name'];
        $item->complete_time = $data['completetime'];
        $item->todolist_id = $data['id'];
        $item->save();
        return back();
    }
    public function deleteitem(Request $request) {
        $data = $request->validate(['id' => ['required', 'integer', 'exists:todolists,id'], 'item_id' => ['required', 'integer', 'exists:todoitems,id']]);

        $todolist = ToDoList::find($data['id']);
        if(!count($todolist->where('user_id', Auth::id())->where('id', $data['id'])->get()) && !count(SharedWith::where('user_id', Auth::id())->where('todolist_id', $data['id'])->get()))
            return redirect('/main')->withErrors(['error' => 'You do not have permission to view this list.']);

        $item = ToDoItem::find($data['item_id']);
        $item->delete();
        return back();
    }
    public function shareList(Request $request) {
        $data = $request->validate(['id' => ['required', 'integer', 'exists:todolists,id'], 'user_id' => ['required', 'integer', 'exists:users,id']]);

        $todolist = ToDoList::find($data['id']);
        if(!count($todolist->where('user_id', Auth::id())->where('id', $data['id'])->get()) && !count(SharedWith::where('user_id', Auth::id())->where('todolist_id', $data['id'])->get()))
            return redirect('/main')->withErrors(['error' => 'You do not have permission to view this list.']);

        if(count(SharedWith::where('user_id', $data['user_id'])->where('todolist_id', $data['id'])->get()))
            return back()->withErrors(['error' => 'This user is already added to this list.']);

        $share = new SharedWith();
        $share->user_id = $data['user_id'];
        $share->todolist_id = $data['id'];
        $share->save();

        return back();
    }
}
