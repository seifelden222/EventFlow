<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizeRequest;
use App\Models\Quizes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizes = Quizes::orderBy('created_at', 'desc')->paginate(10);
        return view('quizes.index', compact('quizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuizeRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('img')) {
            $img_name = time() . '_' . $request->file('img')->getClientOriginalName();
            $validatedData['img'] = $img_name;
            $path = $request->file('img')->store('quizes', 'public');
            $validatedData['img'] = $path;
        }
        Quizes::create($validatedData);
        return redirect()->route('quizes.index')->with('success', 'Quiz created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $quizs = Quizes::find($id);
        return view('quizes.show', compact('quizs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quizs = Quizes::find($id);
        return view('quizes.edit', compact('quizs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuizeRequest $request, Quizes $quizes)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('img')) {

            if ($quizes->img && Storage::disk('public')->exists($quizes->img)) {
                Storage::disk('public')->delete($quizes->img);
            }

            $img_name = time() . '_' . $request->file('img')->getClientOriginalName();
            $validatedData['img'] = $img_name;
            $path = $request->file('img')->store('quizes', 'public');
            $validatedData['img'] = $path;
        }
        Quizes::where('id', $request->id)->update($validatedData);
        return redirect()->route('quizes.index')->with('success', 'Quiz updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quizes $quizes,$id)
    {
        $quiz = Quizes::find($id);
        if (!$quiz) {
            return redirect()->route('quizes.index')->with('error', 'Quiz not found.');
        }

        // // Delete associated image if exists
        // if ($quiz->img && Storage::disk('public')->exists($quiz->img)) {
        //     Storage::disk('public')->delete($quiz->img);
        // }

        $quiz->delete();
        return redirect()->route('quizes.index')->with('success', 'Quiz deleted successfully.');
    }
}
