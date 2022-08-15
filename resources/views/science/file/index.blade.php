<?php
/**
 * @var Science $science
 * @var File $file
 */

use App\Models\File;
use App\Models\Science;

?>

@extends('layouts.app')
@section('title', 'Тест')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-center row">
            <h3 class="px-0">
                Базы по предмету {{ mb_strtolower($science->getName()) }}
                <a href="{{ route('science.file.create', ['slug' => $science->getSlug()]) }}" class="btn btn-secondary">Добавить базу</a>
                <a href="{{ route('science.index') }}" class="btn btn-light" style="background-color: rgba(0, 0, 0, 0.2);">Назад</a>
            </h3>
            @foreach($science->files as $i => $file)
                <a class="card my-1" href="{{ $file->getUrl() }}" target="_blank">
                    <div class="card-body d-flex justify-content-center">
                        <p class="card-text">
                            <u>{{ $science->getName() . ' ' . ++$i }}</u>
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection