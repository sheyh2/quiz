<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class StudentCollection extends ResourceCollection
{
    public function toArray($request): Collection
    {
        return 0;
    }
}
