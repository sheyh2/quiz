<?php
/**
 * @var Collection $sciences
 * @var Science $science
 */

use App\Models\Answer;
use App\Models\Science;
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
            <h1 class="d-inline-block px-0">
                Добавление базы
                <a href="{{ route('science.test.index') }}" class="btn btn-light"
                   style="background-color: rgba(0, 0, 0, 0.2);">Назад</a>
            </h1>

            <form action="{{ route('science.test.store') }}" class="px-0" method="post">
                @csrf

                <div class="form-group">
                    <label for="science">Выберите предмет</label>
                    <select class="form-select" id="science" name="science_id">
                        <option selected value="">Не выбрано</option>

                        @foreach($sciences as $science)
                            <option value="{{ $science->getId() }}">{{ $science->getName() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mt-3">
                    <label for="question">Вопрос теста</label>
                    <textarea class="form-control" id="question" name="question" placeholder="..."></textarea>
                </div>

{{--                <div class="form-group mt-3">--}}
{{--                    <label for="answer1">Правельный ответ на вопрос</label>--}}
{{--                    <input type="text" class="form-control" id="answer1" name="answer[]" placeholder="...">--}}
{{--                </div>--}}

{{--                <div class="form-group mt-5">--}}
{{--                    <label for="answer2">Ответ на вопрос</label>--}}
{{--                    <input type="text" class="form-control" id="answer2" name="answer[]" placeholder="...">--}}
{{--                </div>--}}

{{--                <div class="form-group mt-3">--}}
{{--                    <label for="answer3">Ответ на вопрос</label>--}}
{{--                    <input type="text" class="form-control" id="answer3" name="answer[]" placeholder="...">--}}
{{--                </div>--}}

{{--                <div class="form-group mt-3">--}}
{{--                    <label for="answer4">Ответ на вопрос</label>--}}
{{--                    <input type="text" class="form-control" id="answer4" name="answer[]" placeholder="...">--}}
{{--                </div>--}}

                <button type="submit" class="btn btn-primary mt-3">Add</button>
            </form>
        </div>

        <div class="row">

        </div>
    </div>
@endsection