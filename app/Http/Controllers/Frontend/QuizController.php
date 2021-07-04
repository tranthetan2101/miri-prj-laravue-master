<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\QuizRequest;
use App\Repositories\QuizRepository;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
    /**
     * @var QuizRepository
     */
    protected $quizRepository;

    /**
     * QuizController constructor.
     *
     * @param  QuizRepository  $quizRepository
     */
    public function __construct(QuizRepository $quizRepository)
    {
        $this->quizRepository = $quizRepository;
    }

    /**
     * QuizController index.
     *
     * @param  QuizRequest  $request
     */
    public function index(QuizRequest $request)
    {
        $this->quizRepository->create($request->parameters());
        
        return redirect()->back()->with('status', 'Đã gửi thông tin thành công, MIRI sẽ liên hệ tư vấn cho bạn sớm nhất');
    }
}
