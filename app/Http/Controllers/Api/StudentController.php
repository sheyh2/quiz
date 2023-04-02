<?php

namespace App\Http\Controllers\Api;

use App\Core\Base\ConstKeys;
use App\Http\Resources\StudentCollection;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends ApiController
{
    public function getList(Request $request)
    {
        $students = Student::getInstance()->paginate(
            $request->input('perPage', 18),
            $request->input('filter', []),
        );

        $this->meta = [
            ConstKeys::PER_PAGE => $students->perPage(),
            ConstKeys::CURRENT_PAGE => $students->currentPage(),
            ConstKeys::TOTAL_ITEMS => $students->total(),
            ConstKeys::TOTAL_PAGE => ceil($students->total() / $students->perPage())
        ];

        return $this->composeJson(new StudentCollection($students));
    }

    public function activityToggle($id, Request $request)
    {
        /** @var Student|null $student */
        $student = Student::getInstance()->getById($id);

        if (is_null($student)) {
            $this->status = false;
            $this->code = 404;
            $this->message = 'Student not found!';

            return $this->composeJson();
        }

        $student->update([
            'is_blocked' => !$student->isBlocked()
        ]);
        return $this->composeJson();
    }
}
