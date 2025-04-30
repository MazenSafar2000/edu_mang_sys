<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use App\Models\Quizze;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class ShowQuestion extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0, $questioncount = 0;
    public $answers = [];
    public $timeLeft; // Time remaining in seconds
    protected $listeners = ['autoSubmitQuiz'];



    public function mount()
    {
        $quiz = Quizze::findOrFail($this->quizze_id);

        // Check quiz access period
        if (now()->lt($quiz->start_at)) {
            session()->flash('message', 'الاختبار لم يبدأ بعد.');
            redirect()->to('student_exams')->send();
        }

        if (now()->gt($quiz->end_at)) {
            session()->flash('message', 'انتهى وقت الاختبار.');
            redirect()->to('student_exams')->send();
        }

        $this->timeLeft = $quiz->duration * 60;

        if (Session::has("timer_{$this->quizze_id}_{$this->student_id}")) {
            $this->timeLeft = Session::get("timer_{$this->quizze_id}_{$this->student_id}");
        } else {
            Session::put("timer_{$this->quizze_id}_{$this->student_id}", $this->timeLeft);
        }
    }


    public function render()
    {
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.show-question');
    }

    public function nextQuestion()
    {
        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        }
    }

    public function previousQuestion()
    {
        if ($this->counter > 0) {
            $this->counter--;
        }
    }

    public function finishQuiz()
    {
        $quiz = Quizze::findOrFail($this->quizze_id);

        if (now()->gt($quiz->end_at)) {
            session()->flash('message', 'انتهى وقت الاختبار ولا يمكن تسليمه.');
            return redirect('student_exams');
        }
        $totalScore = 0;
        $answered = false;

        foreach ($this->data as $question) {
            if (isset($this->answers[$question->id])) {
                $answered = true;
                $studentAnswer = $this->answers[$question->id];

                if (trim($studentAnswer) === trim($question->right_answer)) {
                    $totalScore += $question->score;
                }
            }
        }

        $stuDegree = Degree::updateOrCreate(
            [
                'student_id' => $this->student_id,
                'quizze_id' => $this->quizze_id
            ],
            [
                'score' => $answered ? $totalScore : 0,
                'date' => now()
            ]
        );

        // Clear timer session on quiz completion
        Session::forget("timer_{$this->quizze_id}_{$this->student_id}");

        toastr()->success('تم إجراء الاختبار بنجاح');
        return redirect('student_exams');
    }

    public function updateTimer()
    {
        if ($this->timeLeft > 0) {
            $this->timeLeft--;
            Session::put("timer_{$this->quizze_id}_{$this->student_id}", $this->timeLeft);
        } else {
            $this->finishQuiz(); // Auto-submit when time reaches zero
        }
    }

/////////////////////////////////////////////////////////////////////
    public function goToQuestion($index)
    {
        if ($index >= 0 && $index < $this->questioncount) {
            $this->counter = $index;
        }
    }

    public function autoSubmitQuiz()
    {
        $this->finishQuiz();
    }
}
