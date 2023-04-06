<?php

namespace App\Http\Controllers\Api;

use App\Core\Base\ConstKeys;
use App\Http\Requests\Quiz\ActionRequest;
use App\Http\Resources\Quiz\QuizCollection;
use App\Http\Resources\Quiz\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends ApiController
{
    public function getList(Request $request)
    {
        $quizzes = Quiz::getInstance()->paginate(
            $request->input('per_page', 18),
            $request->input('filter', []),
        );

        $this->meta = [
            ConstKeys::PER_PAGE => $quizzes->perPage(),
            ConstKeys::CURRENT_PAGE => $quizzes->currentPage(),
            ConstKeys::TOTAL_ITEMS => $quizzes->total(),
            ConstKeys::TOTAL_PAGE => ceil($quizzes->total() / $quizzes->perPage()),
        ];

        return $this->composeJson(new QuizCollection($quizzes));
    }

    public function show($id)
    {
        /** @var Quiz|null $quiz */
        $quiz = Quiz::getInstance()->getById($id);

        if (is_null($quiz)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Quiz not found!';

            return $this->composeJson();
        }

        return $this->composeJson(new QuizResource($quiz));
    }

    public function store(ActionRequest $request)
    {
        $quiz = Quiz::getInstance()->insertItem([
            'lesson_id' => $request->input('lesson_id'),
            'name' => $request->input('name'),
            'expired_time' => $request->input('expired_time'),
        ]);

        return $this->composeJson(new QuizResource($quiz));
    }

    public function update($id, ActionRequest $request)
    {
        /** @var Quiz|null $quiz */
        $quizInstance = Quiz::getInstance();
        $quiz = $quizInstance->getById($id);

        if (is_null($quiz)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Quiz not found!';

            return $this->composeJson();
        }

        $quizInstance->updateItem($quiz, [
            'lesson_id' => $request->input('lesson_id'),
            'name' => $request->input('name'),
        ]);

        return $this->composeJson(new QuizResource($quiz));
    }

    public function activityToggle($id)
    {
        /** @var Quiz|null $quiz */
        $quiz = Quiz::getInstance()->getById($id);

        if (is_null($quiz)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Quiz not found!';

            return $this->composeJson();
        }

        $quiz->update([
            'is_active' => !$quiz->isActive(),
        ]);
        return $this->composeJson();
    }

    public function destroy($id)
    {
        //
    }
}
