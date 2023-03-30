<?php

namespace App\Http\Controllers\Api;

use App\Core\Base\ConstKeys;
use App\Http\Requests\Lesson\ActionRequest;
use App\Http\Resources\Lesson\LessonCollection;
use App\Http\Resources\Lesson\LessonResource;
use App\Models\File;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends ApiController
{
    public function getList(Request $request)
    {
        $lessons = Lesson::getInstance()
            ->paginate(
                $request->input('per_page', 18),
                $request->input('filter', []),
            );
        $this->meta = [
            ConstKeys::PER_PAGE => $lessons->perPage(),
            ConstKeys::CURRENT_PAGE => $lessons->currentPage(),
            ConstKeys::TOTAL_ITEMS => $lessons->total(),
            ConstKeys::TOTAL_PAGE => ceil($lessons->total() / $lessons->perPage()),
        ];

        return $this->composeJson(new LessonCollection($lessons));
    }

    public function show($id)
    {
        /** @var Lesson|null $lesson */
        $lesson = Lesson::getInstance()->getById($id);

        if (is_null($lesson)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Lesson not found!';

            return $this->composeJson();
        }

        return $this->composeJson(new LessonResource($lesson));
    }

    public function store(ActionRequest $request)
    {
        $lessonInstance = Lesson::getInstance();

        $duplicate = $lessonInstance->duplicate($request->input('courseId'), $request->input('name'));
        if ($duplicate) {
            $this->status = false;
            $this->code = 409;
            $this->message = 'Lesson already exists!';

            return $this->composeJson();
        }

        $lesson = $lessonInstance->store([
            'name' => $request->input('name'),
            'course_id' => $request->input('courseId'),
        ]);

        return $this->composeJson(new LessonResource($lesson));
    }

    public function update($id, ActionRequest $request)
    {
        /** @var Lesson|null $lesson */
        $lessonInstance = Lesson::getInstance();
        $lesson = $lessonInstance->getById($id);

        if (is_null($lesson)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Lesson not found!';

            return $this->composeJson();
        }

        $duplicate = $lessonInstance->duplicate($request->input('courseId'), $request->input('name'));
        if ($duplicate) {
            $this->status = false;
            $this->code = 409;
            $this->message = 'Lesson already exists!';

            return $this->composeJson();
        }

        $lesson->update([
            'name' => $request->input('name'),
        ]);

        return $this->composeJson(new LessonResource($lesson));
    }

    public function activityToggle($id)
    {
        /** @var Lesson|null $lesson */
        $lesson = Lesson::getInstance()->getById($id);

        if (is_null($lesson)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Lesson not found!';

            return $this->composeJson();
        }

        $lesson->update([
            'is_active' => !$lesson->isActive()
        ]);
        return $this->composeJson(new LessonResource($lesson));
    }

    public function destroy($id)
    {
        /** @var Lesson|null $lesson */
        $lesson = Lesson::getInstance()->getById($id);

        if (is_null($lesson)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Lesson not found!';

            return $this->composeJson();
        }

        try {
            DB::beginTransaction();

            File::getInstance()->destroyItems($lesson->files);
            $lesson->delete();

            DB::commit();
            return $this->composeJson();
        } catch (Exception $exception) {
            $this->status = false;
            $this->code = 400;
            $this->message = $exception->getMessage();

            return $this->composeJson();
        }
    }
}
