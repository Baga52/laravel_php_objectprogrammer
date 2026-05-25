<!DOCTYPE html>
<html>

<head>
    <title>Список заявлений</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-purple-500 min-h-screen font-sans">

    <x-app-layout>
        <!-- Добавлен отступ сверху -->
        <div class="max-w-3xl mx-auto pt-24 pb-8 px-4">

            <h1 class="text-3xl font-bold text-green-800 mb-2">НАРУШЕНИЙ.НЕТ</h1>
            <h2 class="text-xl text-green-600 mb-6">Заявления</h2>

            <a href="{{ route('reports.create') }}"
                class="inline-block bg-indigo-600 text-white px-5 py-2.5 rounded-lg hover:bg-indigo-700 transition mb-8 font-medium shadow-sm">
                Создать заявление
            </a>

            <x-filter :sort="$sort" :status="$status" />

            @foreach($reports as $report)
            <div class="bg-white border border-gray-200 rounded-lg p-6 mb-4 shadow-sm hover:shadow-md transition">

                <p class="text-lg font-bold text-green-600 mb-1">
                    № {{ $report->car_number }}
                </p>

                <p class="text-green-700 mb-2">
                    {{ $report->description }}
                </p>

                <p class="text-sm text-green-500 mb-4">
                    Дата: {{ \Carbon\Carbon::parse($report->created_at)->translatedFormat('j F Y H:i') }}
                </p>

                <x-status :type="$report->status->id">
                    {{ $report->status->name }}
                </x-status>

                @if($report->path_img)
                <div class="mb-3">
                    <img src="{{ asset('storage/reports/' . $report->path_img) }}" alt="Фото"
                        class="w-full h-48 object-cover rounded-lg shadow-sm">
                </div>
                @endif

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