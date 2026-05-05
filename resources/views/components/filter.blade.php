@props(['sort', 'status'])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
    <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100">
        <span class="text-sm font-medium text-gray-700">Сортировка:</span>
        <div class="flex gap-2">
            <a href="{{ route('reports.index', ['sort' => 'desc', 'status' => $status]) }}" 
               class="px-3 py-1.5 text-sm rounded-md transition {{ $sort === 'desc' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                ↓ Сначала новые
            </a>
            <a href="{{ route('reports.index', ['sort' => 'asc', 'status' => $status]) }}" 
               class="px-3 py-1.5 text-sm rounded-md transition {{ $sort === 'asc' ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                ↑ Сначала старые
            </a>
        </div>
    </div>

    <div>
        <span class="text-sm font-medium text-gray-700 mb-3 block">Фильтр по статусу:</span>
        <div class="flex flex-wrap gap-2">
            @foreach($statuses as $statusItem)
                <a href="{{ route('reports.index', ['sort' => $sort, 'status' => $statusItem->id]) }}" 
                   class="px-3 py-1.5 text-sm rounded-full transition {{ $status === $statusItem->id ? 'bg-green-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    {{ $statusItem->name }}
                </a>
            @endforeach
        </div>
    </div>
</div>