@extends('layouts.app')

@section('title', 'About')

@section('content')
    <section class="page-intro"><div><p class="eyebrow">About this project</p><h1>Simple plans. Clearer days.</h1><p class="lead">A small application to keep everyday tasks in view.</p></div></section>

    <section class="panel about-panel">
        <span class="small-label">Tasks for Today Management System</span>
        <h2>Built by Carl Vincent Tenorio.</h2>
        <p>This project brings today's tasks, a complete task list, and a personal profile together in one simple application.</p>
        <p>Developed for IT0049 Web System Technologies, Technical Summative Assessment 3, using Laravel, Eloquent, and Blade.</p>
        <a class="text-link" href="{{ route('welcome') }}">See today's tasks <span aria-hidden="true">&rarr;</span></a>
    </section>
@endsection
