<!DOCTYPE html>
<html>
<head>
    <title>Создать заявление</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <h1>НАРУШЕНИЙ.НЕТ</h1>
    <h2>Создать заявление</h2>
    
    <form method="POST" action="{{ route('reports.store') }}">
        @csrf
        
        <div>
            <label for="car_number">Номер автомобиля:</label>
            <input type="text" name="car_number" id="car_number" required>
        </div>
        
        <div>
            <label for="description">Описание:</label>
            <textarea name="description" id="description" required></textarea>
        </div>
        
        <button type="submit">Создать</button>
    </form>
</body>
</html>