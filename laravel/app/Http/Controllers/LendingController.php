<?php

namespace App\Http\Controllers;

use App\Models\Lending;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LendingController extends Controller
{
    public function index()
    {
        return Lending::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $record = new Lending();
        $record->fill($request->all());
        $record->save();
    }

    /**
     * Display the specified resource.
     */
    public function show($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)
        ->where('copy_id', $copy_id)
        ->where('start', $start)
        ->get();
        return $lending[0];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $user_id, $copy_id, $start)
    {
        $record = $this->show($user_id, $copy_id, $start);
        $record-> fill($request->all()); 
        $record->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($user_id, $copy_id, $start)
    {
        $this->show($user_id, $copy_id, $start) ->delete();
    }

    // lekérdezések
    public function lendingsWithCopies(){
        $user = Auth::user();	//bejelentkezett felhasználó
        return Lending::with('copies')
        ->where('user_id','=',$user->id)
        ->get();
    }

    public function dateSpeci(){
        $user = Auth::user();	//bejelentkezett felhasználó
        return Lending::with('specificDate')
        ->where('start','=',"1980-04-23")
        ->get();
    }

    public function copiSpeci($copy_id){
        $user = Auth::user();	//bejelentkezett felhasználó
        return Lending::with('specificCopy')
        ->where('copies','=', $copy_id)
        ->get();
    }

    public function lendinCount(){
        $user = Auth::user();
        $lendings = DB::table('lendins as 1')
        -> where ('user_id',$user->id)
        ->count();
        return $lendings;
    }

    public function aktivlendinCount(){
        $user = Auth::user();
        $lendings = DB::table('lendins as 1')
        -> where ('user_id',$user->id)
        ->whereNull('end')
        ->count();
        return $lendings;
    }  

    public function lendinBookCount(){
        $user = Auth::user();
        $books = DB::table('lendins as 1')
        ->join('copies as c', 'l.copy_id', 'c.cpoy_id')
        -> where ('user_id',$user->id)
        -> distinct('book_id')
        ->count();
        return $books;
    }

    public function lendinBooksdata(){
        $user = Auth::user();
        $books = DB::table('lendins as 1')
        ->join('copies as c', 'l.copy_id', 'c.cpoy_id')
        ->join('books as c', 'c.book_id', 'b.book_id')
        ->select('b.book_id','author','title')
        -> where ('user_id',$user->id)
        ->groupBy('b.book_id')
        ->get();
        return $books;
    }

    public function lendinBooksdata2(){
        $user = Auth::user();
        $books = DB::table('lendins as 1')
        ->join('copies as c', 'l.copy_id', 'c.cpoy_id')
        ->join('books as c', 'c.book_id', 'b.book_id')
        ->select('b.book_id','author','title')
        ->where ('user_id',$user->id)
        ->groupBy('b.book_id')
        ->having('count(b.book_id)', '<', 2)
        ->get();
        return $books;
    }

}