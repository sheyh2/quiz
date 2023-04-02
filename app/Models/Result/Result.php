<?php

namespace App\Models\Result;

use App\Models\Student;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Result.php
 * @package App\Models\Result
 *
 * @property int $id
 * @property int $quiz_id
 * @property int $student_id
 * @property int $result
 * @property string $created_at
 * @property string $updated_at
 */
class Result extends Model
{
    protected $table = 'results';
    protected $fillable = [
        'quiz_id',
        'student_id',
        'result',
    ];

    public function paginate(int $items, array $filter): LengthAwarePaginator
    {
        $studentQuery = Student::query()
            ->join('results', 'results.student_id', '=', 'students.id');

        if (isset($filter['quizId'])) {
            $studentQuery = $studentQuery
                ->where('results.quiz_id', '=', $filter['quizId']);
        }

        if (isset($filter['name'])) {
            $studentQuery = $studentQuery
                ->whereRaw('("students"."name" like \'%'.$filter['name'].'%\' or "students"."surname" like \'%'.$filter['name'].'%\')');
        }

        return $studentQuery
            ->distinct()
            ->select('students.*')
            ->paginate($items);
    }

    // Getters

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getQuizId(): int
    {
        return $this->quiz_id;
    }

    /**
     * @return int
     */
    public function getStudentId(): int
    {
        return $this->student_id;
    }

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->result;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    // Instance

    public static function getInstance(): Result
    {
        return new static();
    }
}
