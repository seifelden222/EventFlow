<?php

namespace App\Http\Controllers;

use App\Models\Quizes;
use App\Models\Submissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    // Show quiz take page
    public function take(Quizes $quize)
    {
        $quize->load('questions');
        return view('quizes.take', ['quiz' => $quize]);
    }

    // Store submission
    public function store(Request $request, Quizes $quize)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $answers = $request->input('answers', []); // array keyed by question id => selected index

        $score = 0;
        foreach ($quize->questions as $q) {
            $qid = (string)$q->id;
            if (!isset($answers[$qid])) continue;
            $selected = intval($answers[$qid]);
            if ($selected === intval($q->correct_index)) {
                $score++;
            }
        }

        $submission = Submissions::create([
            'quiz_id' => $quize->id,
            'user_id' => $user->id,
            'answers_json' => $answers,
            'score' => $score,
        ]);

        return redirect()->route('submissions.show', $submission);
    }

    public function show(Submissions $submission)
    {
        $submission->load('quiz');
        return view('quizes.submission', ['submission' => $submission]);
    }
}
