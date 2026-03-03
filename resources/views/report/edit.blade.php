<!DOCTYPE html>
<html>
<head>
    <title>Редактировать заявление</title>
</head>
<body>
    <h1>НАРУШЕНИЙ.НЕТ</h1>
    <h2>Редактировать заявление</h2>
    
    <form action="{{ route('reports.update', $report->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Номер автомобиля:</label>
        <input type="text" name="car_number" value="{{ $report->car_number }}" required>
        
        <label>Описание:</label>
        <textarea name="description" required>{{ $report->description }}</textarea>
        
        <button type="submit">Обновить</button>
    </form>
</body>
</html>