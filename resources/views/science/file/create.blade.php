<?php
/**
 * @var ViewErrorBag $errors
 * @var Science $science
 */

use App\Models\Science;
use Illuminate\Support\ViewErrorBag;

$errors = session('errors');

?>

@extends('layouts.app')
@section('title', 'Добавление базы')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <h1 class="d-inline-block px-0">
                Добавление базы
                <a href="{{ route('science.file.index', ['slug' => $science->getSlug()]) }}" class="btn btn-light" style="background-color: rgba(0, 0, 0, 0.2);">
                    Назад
                </a>
            </h1>

            @if($errors)
                <ul class="list-group">
                    @foreach($errors->getMessages()[0] as $error)
                        <li class="list-group-item-danger list-unstyled p-1">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="post" class="px-0" action="{{ route('science.file.store', ['slug' => $science->getSlug()]) }}" multiple="multipart/form-data">
                @csrf

                <div class="form-group mt-3">
                    <label for="file" class="form-label">Выберите файл базы</label>
                    <input type="file" class="form-control form-control-lg" id="file" name="file">
                </div>

                <button type="submit" class="btn btn-primary mt-3">Добавить</button>
            </form>
        </div>
    </div>
@endsection