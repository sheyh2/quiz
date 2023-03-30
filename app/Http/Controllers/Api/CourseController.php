<?php

namespace App\Http\Controllers\Api;

use App\Core\Base\ConstKeys;
use App\Http\Requests\Course\ActionRequest;
use App\Http\Resources\Course\CourseCollection;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends ApiController
{
    public function getList(Request $request)
    {
        $courses = Course::getInstance()->paginate($request->input('per_page', 18));
        $this->meta = [
            ConstKeys::PER_PAGE => $courses->perPage(),
            ConstKeys::CURRENT_PAGE => $courses->currentPage(),
            ConstKeys::TOTAL_ITEMS => $courses->total(),
            ConstKeys::TOTAL_PAGE => ceil($courses->total() / $courses->perPage()),
        ];

        return $this->composeJson(new CourseCollection($courses));
    }

    public function show($id)
    {
        /** @var Course|null $course */
        $course = Course::getInstance()->getById($id);

        if (is_null($course)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Course not found!';

            return $this->composeJson();
        }

        return $this->composeJson(new CourseResource($course));
    }

    public function store(ActionRequest $request)
    {
        $course = Course::getInstance()->store([
            'name' => $request->input('name'),
            'is_active' => $request->input('is_active'),
        ]);

        return $this->composeJson(new CourseResource($course));
    }

    public function update($id, ActionRequest $request)
    {
        /** @var Course|null $course */
        $course = Course::getInstance()->getById($id);

        if (is_null($course)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Course not found!';

            return $this->composeJson();
        }

        $course->update([
            'name' => $request->input('name'),
            'is_active' => $request->input('is_active'),
        ]);

        return $this->composeJson(new CourseResource($course));
    }

    public function activityToggle($id)
    {
        /** @var Course|null $course */
        $course = Course::getInstance()->getById($id);

        if (is_null($course)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Lesson not found!';

            return $this->composeJson();
        }

        $course->update([
            'is_active' => !$course->isActive()
        ]);
        return $this->composeJson(new CourseResource($course));
    }

    public function destroy($id)
    {
        //
    }
}
