<!DOCTYPE html>
<html>
<head>
    <title>Список заявлений</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>НАРУШЕНИЙ.НЕТ</h1>
    <h2>Заявления</h2>
    
    <a href="{{ route('reports.create') }}">Создать заявление</a>
    
    @foreach($reports as $report)
        <div>
            <p class="dark:text-purple-500 font-serif">Номер авто: {{ $report->car_number }}</p>
            <p class="dark:text-purple2-500 font-serif">Описание: {{ $report->description }}</p>
            <p class="dark:text-purple3-500 font-serif">Дата: {{ $report->created_at }}</p>
            
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