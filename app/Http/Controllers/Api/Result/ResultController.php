<?php

namespace App\Http\Controllers\Api\Result;

use App\Core\Base\ConstKeys;
use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\Result\ResultCollection;
use App\Models\Result\Result;
use Illuminate\Http\Request;

class ResultController extends ApiController
{
    public function getList(Request $request)
    {
        $students = Result::getInstance()->paginate(
            $request->input('per_page', 18),
            $request->input('filter', []),
        );

        $this->meta = [
            ConstKeys::PER_PAGE => $students->perPage(),
            ConstKeys::CURRENT_PAGE => $students->currentPage(),
            ConstKeys::TOTAL_ITEMS => $students->total(),
            ConstKeys::TOTAL_PAGE => ceil($students->total() / $students->perPage()),
        ];

        return $this->composeJson(new ResultCollection($students));
    }
}
