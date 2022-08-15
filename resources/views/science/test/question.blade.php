<?php
/**
 * @var Collection $tests
 * @var Test $test
 * @var Answer $answer
 */

use App\Models\Answer;
use App\Models\Test;
use Illuminate\Database\Eloquent\Collection;

?>

@extends('layouts.app')
@section('title', 'Тест')

@push('my-js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-10 col-lg-10">
                <div class="border" data-last="{{ $tests->count() }}">
                    @foreach($tests as $i => $test)
                        <form action="#" method="post" id="test{{ $i + 1 }}" class="d-none">
                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row justify-content-between align-items-center mcq">
                                    <h4>MCQ Quiz</h4>
                                    <span>
                                        ({{ $i + 1 }} of {{ $tests->count() }})
                                    </span>
                                </div>
                            </div>

                            <div class="question bg-white p-3 border-bottom">
                                <div class="d-flex flex-row align-items-center question-title">
                                    <h3 class="text-primary">Q.</h3>
                                    <h5 class="mt-1 ml-2">
                                        {{ $test->getQuestion() }}
                                    </h5>
                                </div>

                                @foreach($test->answers as $answer)
                                    <div class="ans ml-2">
                                        <label class="radio answer w-100">
                                            <input type="radio" name="answer" value="{{ $answer->getId() }}">
                                            <span class="w-100">{{ $answer->getAnswer() }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    @endforeach

                    <div class="d-flex flex-row justify-content-between align-items-center p-3 bg-white">
                        <button class="btn btn-primary d-flex align-items-center btn-danger disabled" type="button" id="prev">
                            <i class="fa fa-angle-left mt-1 mr-1"></i>
                            &nbsp;ПРЕДЫДУЩИЙ
                        </button>

                        <button class="btn btn-primary border-primary align-items-center btn-primary"
                                type="button" id="next">
                            СЛЕДУЮЩИЙ
                            <i class="fa fa-angle-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection