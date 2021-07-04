<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Repositories\QuizRepository;
use Illuminate\Http\Request;

/**
 * Class QuizController.
 */
class QuizController extends Controller
{
    /**
     * @var QuizRepository
     */
    protected $quizRepository;

    /**
     * QuizController constructor.
     *
     * @param QuizRepository $quizRepository
     */
    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.quiz.index');
    }


    public function show(Request $request, Quiz $quiz)
    {
        return view('backend.quiz.show')
            ->withQuiz($quiz);
    }


    public function destroy($deletedQuizId)
    {
        $deletedQuiz= Quiz::findOrFail($deletedQuizId);
        $this->quizRepository->destroy($deletedQuiz);

        return redirect()->route('admin.quiz.index')->withFlashSuccess(__('The quiz was permanently deleted.'));
    }

}
