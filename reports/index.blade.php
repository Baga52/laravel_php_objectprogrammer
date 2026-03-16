@extends('layouts.app')

@section('content')
<h1>Список отчетов</h1>

@if($reports->count() > 0)
    @foreach($reports as $report)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 5px;">
            <h2>Отчет #{{ $report->car_number }}</h2>
            <p>{{ $report->description }}</p>
            <p><strong>Дата:</strong> {{ $report->created_at->format('d.m.Y H:i') }}</p>
            
            @if($report->status)
                <p><strong>Статус:</strong> {{ $report->status->name }}</p>
            @else
                <p><strong>Статус:</strong> <em>не указан</em></p>
            @endif

            <a href="{{ route('reports.show', $report->id) }}">Подробнее</a> |
            <a href="{{ route('reports.edit', $report->id) }}">Редактировать</a>
        </div>
    @endforeach

    {{ $reports->links() }}

@else
    <p>Отчетов пока нет. <a href="{{ route('reports.create') }}">Создать первый</a>.</p>
@endif
@endsection