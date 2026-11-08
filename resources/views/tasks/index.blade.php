@extends('layouts.app')

@section('title', 'Task List')

@section('content')
    <section class="page-intro">
        <div><p class="eyebrow">Your schedule</p><h1>Everything on your list.</h1><p class="lead">All your tasks, from the earliest date to the latest.</p></div>
        <a class="text-link" href="{{ route('welcome') }}">Back to today <span aria-hidden="true">&rarr;</span></a>
    </section>

    <section class="panel">
        <div class="panel-heading"><div><h2>Task List</h2><p>Past, present, and upcoming tasks.</p></div><span class="small-label">{{ $tasks->count() }} {{ $tasks->count() === 1 ? 'task' : 'tasks' }}</span></div>
        @include('partials.task-table', [
            'tableCaption' => 'All tasks ordered by date, earliest first',
            'emptyMessage' => 'No tasks are available yet.',
        ])
    </section>
@endsection
