<!DOCTYPE html>
<html>
<head>
    <title>Список заявлений</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-purple-500 min-h-screen p-8 font-sans">

    <div class="max-w-3xl mx-auto">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-2">НАРУШЕНИЙ.НЕТ</h1>
        <h2 class="text-xl text-gray-600 mb-6">Заявления</h2>
        
        <a href="{{ route('reports.create') }}" 
           class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition mb-8 font-medium shadow-sm">
           Создать заявление
        </a>
        <div>
            <span>Сортировка по дате создания: </span>
            <a href="{{ route('reports.index', ['sort' => 'desc', 'status' => $status]) }}">сначала новые</a>
            <a href="{{ route('reports.index', ['sort' => 'asc', 'status' => $status]) }}">сначала старые</a>
        </div>
        <div>
            <p>Фильтрация по статусу заявки</p>
            <ul>
                @foreach ($statuses as $status)
                    <li>
                        <a href="{{ route('reports.index', ['sort' => $sort, 'status' => $status->id]) }}">{{$status->name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
        
        @foreach($reports as $report)
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4 shadow-sm hover:shadow-md transition">
                
                <p class="text-lg font-bold text-gray-900 mb-1">
                    № {{ $report->car_number }}
                </p>
                
                <p class="text-gray-700 mb-2">
                    {{ $report->description }}
                </p>
                
                <p class="text-sm text-gray-500 mb-4">
                    Дата: {{ $report->created_at->format('d.m.Y H:i') }}
                </p>
                <p>{{$report->status->name}}</p>
                <div class="flex items-center gap-3 border-t border-gray-100 pt-4">
                    <a href="{{ route('reports.edit', $report->id) }}" 
                       class="text-indigo-600 hover:text-indigo-800 text-sm font-medium hover:underline">
                        Редактировать
                    </a>

                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                        @csrf
                        @method('delete')
                        <button type="submit" 
                                class="text-red-600 hover:text-red-800 text-sm font-medium hover:underline focus:outline-none">
                            Удалить
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    {{ $reports->appends(request()->query())->links() }}
</body>
</html>