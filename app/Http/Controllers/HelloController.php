<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\DB;

class HelloController extends Controller
{

    public function index(Request $request)
    {
        $items = DB::table('people')->get();
        return view('hello.index', ['items' => $items]);
    }
    public function show(Request $request)
    {
        $page = $request->page;
        $items = DB::table('people')
        ->offset($page * 3)
        ->limit(3)
        ->get();
        return view('hello.show', ['items' => $items]);
    }

    public function post(Request $request)
    {
        $items = DB::select('select * from people');
        return view('hello.index', ['items' => $items]);
    }

    public function add(Request $request)
    {
        return view('hello.add');
    }

    public function create(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        // DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);
        DB::table('people')->insert($param);
        return redirect('/hello');
    }

    public function edit(Request $request)
    {
        $item = DB::table('people')
        ->where('id', $request->id)->first();
        return view('hello.edit', ['form' => $item]);
    }

    public function update(Request $request)
    {
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')
        ->where('id', $request->id)
        ->update($param);
        return redirect('/hello');
    }
}
