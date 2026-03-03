<!DOCTYPE html>
<html>
<head>
    <title>Список заявлений</title>
</head>
<body>
    <h1>НАРУШЕНИЙ.НЕТ</h1>
    <h2>Заявления</h2>
    
    <a href="{{ route('reports.create') }}">Создать заявление</a>
    
    @foreach($reports as $report)
        <div>
            <p>Номер авто: {{ $report->car_number }}</p>
            <p>Описание: {{ $report->description }}</p>
            <p>Дата: {{ $report->created_at }}</p>
            
            <form action="{{ route('reports.destroy', $report->id) }}" method="POST">
                @csrf
                @method('delete')
                <button type="submit">Удалить</button>
            </form>
            
            <a href="{{ route('reports.edit', $report->id) }}">Редактировать</a>
        </div>
        <hr>
    @endforeach
</body>
</html>