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
            <h3 class="d-inline-block">
                Выберите предмет на котором хотите пройти тест
                <a href="{{ route('science.test.create') }}" class="btn btn-secondary">Добавить тест</a>
                <a href="{{ route('welcome') }}" class="btn btn-light" style="background-color: rgba(0, 0, 0, 0.2);">Назад</a>
            </h3>
            @foreach($sciences as $science)
                <a class="card my-1" href="{{ route('science.test.question') }}">
                    <div class="card-body d-flex justify-content-center">
                        <p class="card-text">
                            <u>{{ $science->getName() }}</u>
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection