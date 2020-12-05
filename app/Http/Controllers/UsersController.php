<?php

namespace App\Http\Controllers;

use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class UsersController extends Controller
{
    public function history(Request $request)
    {
        $histories = History::orderBy("created_at")->paginate(5);
        $columns = Schema::getColumnListing('histories');
        // dump($columns);
        // dd($histories);
        return view('auth.users.history', compact('histories','columns'));
    }
}
