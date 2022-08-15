@extends('layouts.app')
@section('title', 'Тест')

@push('my-js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <h1 class="d-inline-block">
                Добавление базы
                <a href="{{ route('science.index') }}" class="btn btn-light" style="background-color: rgba(0, 0, 0, 0.2);">Назад</a>
            </h1>

            <form>
                <div class="form-group">
                    <label for="name">Название предмета</label>
                    <input type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Английский">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Добавить</button>
            </form>
        </div>
    </div>
@endsection