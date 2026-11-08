@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="page-intro">
        <div>
            <p class="eyebrow">{{ today()->format('l, F j, Y') }}</p>
            <h1>Make room for what matters.</h1>
            <p class="lead">A clear look at the tasks on your schedule today.</p>
        </div>
        <a class="button" href="{{ route('tasks.index') }}">View all tasks <span aria-hidden="true">&rarr;</span></a>
    </section>

    <section class="stats-grid" aria-label="Today's task summary">
        <div class="stat"><span class="stat-label">Scheduled today</span><strong>{{ $tasks->count() }}</strong></div>
        <div class="stat"><span class="stat-label">In progress</span><strong>{{ $tasks->where('status', 'in progress')->count() }}</strong></div>
        <div class="stat"><span class="stat-label">Completed</span><strong>{{ $tasks->where('status', 'completed')->count() }}</strong></div>
    </section>

    <section class="panel">
        <div class="panel-heading"><div><h2>Today's tasks</h2><p>Focus on one thing at a time.</p></div><span class="small-label">{{ $tasks->count() }} {{ $tasks->count() === 1 ? 'task' : 'tasks' }}</span></div>
        @include('partials.task-table', [
            'tableCaption' => 'Tasks scheduled for today',
            'emptyMessage' => 'No tasks are scheduled for today.',
        ])
    </section>
@endsection
