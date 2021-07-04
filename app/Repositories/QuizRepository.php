<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Models\Quiz;
use App\Repositories\BaseRepository;

/**
 * Class QuizRepository.
 */
class QuizRepository extends BaseRepository
{
    /**
     * Quiz constructor.
     *
     * @param  Quiz  $model
     */
    public function __construct(Quiz $model)
    {
        $this->model = $model;
    }

    /**
     * Insert data to Quiz
     *
     * @return mixed
     */
    public function create($params)
    {
        return $this->model->create($params);
    }
    /**
     * @param Quiz $quiz
     * @return bool
     * @throws GeneralException
     */
    public function destroy(Quiz $quiz): bool
    {
        if ($quiz->forceDelete()) {
            return true;
        }

        throw new GeneralException(__('There was a problem permanently deleting this quiz. Please try again.'));
    }

}
