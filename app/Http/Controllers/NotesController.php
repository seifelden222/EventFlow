<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Mockery\Matcher\Not;

class NotesController extends Controller
{

    public function index()
    {
        try {
            $notes = Notes::with('user')->orderBy('created_at', 'desc')->paginate(12);
            return view('notes.index', compact('notes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading notes: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('notes.create');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the note: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $varidatedData = $request->validate([
                'content' => 'required|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->hasFile('img')) {
                $img_name = time() . '_' . $request->file('img')->getClientOriginalName();
                $varidatedData['img'] = $img_name;
                $path = $request->file('img')->store('notes', 'public');
                $varidatedData['img'] = $path;
            }
            if (auth()->check()) {
                $varidatedData['user_id'] = auth()->id();
            }
            Notes::create($varidatedData);
            return redirect()->route('notes.index')->with('success', 'Note created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while creating the note: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $note = Notes::findOrFail($id);
            return view('notes.show', compact('note'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the note: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $note = Notes::findOrFail($id);
            return view('notes.edit', compact('note'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while loading the note: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notes $notes)
    {

        try {

            $varidatedData = $request->validate([
                'content' => 'required|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // // Handle remove image checkbox
            // if ($request->has('remove_image') && $notes->img) {
            //     if (Storage::disk('public')->exists($notes->img)) {
            //         Storage::disk('public')->delete($notes->img);
            //     }
            //     $varidatedData['img'] = null;
            // }

            if ($request->hasFile('img')) {
                if ($notes->main_image && Storage::disk('public')->exists($notes->main_image)) {
                    Storage::disk('public')->delete($notes->main_image);
                }
                $image_name = time() . '_' . $request->file('img')->getClientOriginalName();
                $varidatedData['img'] = $image_name;
                $path = $request->file('img')->store('notes', 'public');
                $varidatedData['img'] = $path;
            }
            $notes->update($varidatedData);
            return redirect()->route('notes.show', $notes->id)->with('success', 'Note updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating the note: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notes $notes)
    {
        try {
            $notes = Notes::findOrFail($notes->id);
            if ($notes->img && Storage::disk('public')->exists($notes->img)) {
                Storage::disk('public')->delete($notes->img);
            }
            $notes->delete();
            return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the note: ' . $e->getMessage());
        }
    }
}
