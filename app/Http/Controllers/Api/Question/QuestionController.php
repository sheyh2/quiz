<?php

namespace App\Http\Controllers\Api\Question;

use App\Core\Base\ConstKeys;
use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Question\ActionRequest;
use App\Http\Resources\Question\QuestionCollection;
use App\Http\Resources\Question\QuestionResource;
use App\Models\Question\Answer;
use App\Models\Question\Question;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends ApiController
{
    public function getList(Request $request)
    {
        $quizzes = Question::getInstance()->paginate(
            $request->input('perPage', 18),
            $request->input('filter', []),
        );

        $this->meta = [
            ConstKeys::PER_PAGE => $quizzes->perPage(),
            ConstKeys::CURRENT_PAGE => $quizzes->currentPage(),
            ConstKeys::TOTAL_ITEMS => $quizzes->total(),
            ConstKeys::TOTAL_PAGE => ceil($quizzes->total() / $quizzes->perPage()),
        ];

        return $this->composeJson(new QuestionCollection($quizzes));
    }

    public function show($id)
    {
        /** @var Question|null $question */
        $question = Question::getInstance()->getById($id);

        if (is_null($question)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Quiz not found!';

            return $this->composeJson();
        }

        return $this->composeJson(new QuestionResource($question));
    }

    public function store(ActionRequest $request)
    {
        try {
            DB::beginTransaction();

            /** @var Question $question */
            $question = Question::getInstance()->insertItem([
                'quiz_id' => $request->input('quizId'),
                'question' => $request->input('question'),
            ]);

            $items = [];
            foreach ($request->input('answers') as $item) {
                $items[] = [
                    'question_id' => $question->getId(),
                    'answer' => $item['answer'],
                    'is_correct' => $item['isCorrect'],
                ];
            }

            Answer::getInstance()->insertItems($items);

            DB::commit();
            return $this->composeJson(new QuestionResource($question));
        } catch (Exception $exception) {
            DB::rollBack();

            $this->status = false;
            $this->code = 400;
            $this->message = $exception->getMessage();

            return $this->composeJson();
        }
    }

    public function update($id, ActionRequest $request)
    {
        /** @var Question|null $question */
        $questionInstance = Question::getInstance();
        $question = $questionInstance->getById($id);

        if (is_null($question)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Question not found!';

            return $this->composeJson();
        }

        try {
            DB::beginTransaction();

            $questionInstance->updateItem($question, [
                'quiz_id' => $request->input('quizId'),
                'question' => $request->input('question'),
            ]);

            $items = [];
            foreach ($request->input('answers') as $item) {
                $items[] = [
                    'question_id' => $question->getId(),
                    'answer' => $item['answer'],
                    'is_correct' => $item['isCorrect'],
                ];
            }

            Answer::getInstance()->updateItems($question->answers, $items);

            DB::commit();
            return $this->composeJson(new QuestionResource($question));
        } catch (Exception $exception) {
            DB::rollBack();

            $this->status = false;
            $this->code = 400;
            $this->message = $exception->getMessage();

            return $this->composeJson();
        }
    }

    public function destroy($id)
    {
        /** @var Question|null $question */
        $questionInstance = Question::getInstance();
        $question = $questionInstance->getById($id);

        if (is_null($question)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Question not found!';

            return $this->composeJson();
        }

        try {
            DB::beginTransaction();

            Answer::getInstance()->destroyItems($question->getId());
            Question::getInstance()->destroyItem($question);

            DB::commit();
            return $this->composeJson();
        } catch (Exception $exception) {
            DB::rollBack();

            $this->status = false;
            $this->code = 400;
            $this->message = $exception->getMessage();

            return $this->composeJson();
        }
    }
}
