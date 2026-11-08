@if($tasks->isEmpty())
    <div class="empty-state">
        <span class="eyebrow">Nothing scheduled</span>
        <p>{{ $emptyMessage }}</p>
    </div>
@else
    <div class="table-scroll" role="region" aria-label="{{ $tableCaption }}" tabindex="0">
        <table class="task-table">
            <caption class="sr-only">{{ $tableCaption }}</caption>
            <thead>
                <tr>
                    <th scope="col">Task</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td class="task-title">{{ $task->title }}</td>
                        <td><time datetime="{{ $task->task_date->format('Y-m-d') }}">{{ $task->task_date->format('M d, Y') }}</time></td>
                        <td>
                            <span class="status {{ $task->status === 'completed' ? 'status-completed' : ($task->status === 'in progress' ? 'status-progress' : 'status-pending') }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
