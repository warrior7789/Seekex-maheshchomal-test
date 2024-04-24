<?php

// BallController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ball;

class BallController extends Controller
{
    public function create()
    {
        return view('balls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'size' => 'required|numeric|min:1',
        ]);
        //ball::truncate();
        $ball = new Ball();
        $ball->color = $request->color;
        $ball->size = $request->size;
        $ball->save();

        // Empty all buckets whenever a new ball is created
        //Bucket::truncate();

        return redirect('/buckets/create')->with('success', 'Ball created successfully!');
    }
}
