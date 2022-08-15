@extends('layouts.app')
@section('title', 'Шпаргалки')

@section('content')
    <a class="card d-flex justify-content-center" style="width: 18rem;" href="{{ route('science.index') }}">
        <div class="card-body d-flex justify-content-center">
            <p class="card-text">
                <u>Базы</u>
            </p>
        </div>
    </a>

    <a class="card" style="width: 18rem;" href="{{ route('science.test.index') }}">
        <div class="card-body d-flex justify-content-center">
            <p class="card-text">
                <u>Пройти тест</u>
            </p>
        </div>
    </a>
@endsection