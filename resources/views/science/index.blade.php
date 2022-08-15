<?php
/**
 * @var Collection $sciences
 * @var Science $science
 */

use App\Models\Science;
use Illuminate\Database\Eloquent\Collection;

?>

@extends('layouts.app')
@section('title', 'Предметы')

@push('my-js')
    <script src="{{ asset('assets/js/main.js') }}"></script>
@endpush

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <h1 class="d-inline-block">
                Предметы
                <a href="{{ route('science.create') }}" class="btn btn-secondary">Добавить</a>
                <a href="{{ route('welcome') }}" class="btn btn-light" style="background-color: rgba(0, 0, 0, 0.2);">Назад</a>
            </h1>
            @foreach($sciences as $science)
                <a class="card my-1" href="{{ route('science.file.index', ['slug' => $science->getSlug()]) }}">
                    <div class="card-body d-flex justify-content-center">
                        <p class="card-text">
                            <u>Базы по {{ mb_strtolower($science->getName()) }}</u>
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection