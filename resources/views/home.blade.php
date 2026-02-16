<?php
// Устанавливаем кодировку
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Главная страница</title>
</head>
<body>
    <header>
        <div class="container header-content">
            <div class="logo">МойСайт</div>
            <nav>
                <ul>
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="arrays.php">Массивы</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1>Добро пожаловать на главную страницу!</h1>
        
        <img src="{{ Vite::asset('resources/images/cat1.jpg') }}" alt="">
        
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. 
        Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut 
        eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non 
        venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus. Mauris iaculis porttitor 
        posuere. Praesent id metus massa, ut blandit odio.</p>
    </main>

    <footer>
        <div class="container">
            &copy; <?php echo date('Y'); ?> Апальков Богдан Сарварович. Все права защищены.
        </div>
    </footer>
</body>
</html>