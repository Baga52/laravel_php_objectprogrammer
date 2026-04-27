<!DOCTYPE html>
<html>

<head>
    <title>Список заявлений</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-purple-500 min-h-screen p-8 font-sans">

    <x-app-layout>
        <div class="max-w-3xl mx-auto">

            <h1 class="text-3xl font-bold text-green-800 mb-2">НАРУШЕНИЙ.НЕТ</h1>
            <h2 class="text-xl text-green-600 mb-6">Заявления</h2>

            <a href="{{ route('reports.create') }}"
                class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition mb-8 font-medium shadow-sm">
                Создать заявление
            </a>
            <x-filter :sort=$sort :status=$status>
            <div>
                <span class="text-xl text-green-600 mb-9">Сортировка по дате создания: </span>
                <a href="{{ route('reports.index', ['sort' => 'desc', 'status' => $status]) }}" class="text-l text-purple-600 mb-6">сначала новые</a>
                <a href="{{ route('reports.index', ['sort' => 'asc', 'status' => $status]) }}" class="text-l text-purple-600 mb-6">сначала старые</a>
            </div>
            <div>
                <p class="text-xl text-green-600 mb-9">Фильтрация по статусу заявки</p>
                <ul>
                    @foreach ($statuses as $status)
                    <li class="text-l text-purple-600 mb-6">
                        <a href="{{ route('reports.index', ['sort' => $sort, 'status' => $status->id]) }}">{{$status->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            </x-filter>
            @foreach($reports as $report)
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4 shadow-sm hover:shadow-md transition">

                <p class="text-lg font-bold text-green-600 mb-1">
                    № {{ $report->car_number }}
                </p>

                <p class="text-green-700 mb-2">
                    {{ $report->description }}
                </p>

                <p class="text-sm text-green-500 mb-4">
                    Дата: {{ $report->created_at->format('d.m.Y H:i') }}
                </p>
                <x-status :type="$report->status->id">
                    {{$report->status->name}}
                </x-status>
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
    </x-app-layout>
</body>

</html>