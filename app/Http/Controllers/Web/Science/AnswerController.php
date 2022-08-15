<?php

namespace App\Http\Controllers\Web\Science;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        return view('science.test.answer.index');
    }
}
