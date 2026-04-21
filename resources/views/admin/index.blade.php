<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

        <h1 class="text-3xl font-bold text-green-800 mb-2">Административная панель</h1>
        <h2 class="text-xl text-green-600 mb-6">Управление заявками</h2>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">

            <div class="bg-green-50 border-b border-gray-200">
                <div class="grid grid-cols-12 gap-4 p-4 font-bold text-green-800 text-sm uppercase">
                    <div class="col-span-2">ФИО (Логин)</div>
                    <div class="col-span-5">Текст заявления</div>
                    <div class="col-span-2">Номер автомобиля</div>
                    <div class="col-span-3">Смена статуса</div>
                </div>
            </div>

            @foreach($reports as $report)
            <div class="border-b border-gray-100 hover:bg-gray-50 transition last:border-0">
                <div class="grid grid-cols-12 gap-4 p-4 items-center">

                    <div class="col-span-2 text-green-700 font-medium truncate" title="{{ $report->user->login ?? 'Нет пользователя' }}">
                        {{ $report->user->login ?? 'Пользователь не найден' }}
                    </div>

                    <div class="col-span-5 text-gray-700 text-sm break-words max-h-24 overflow-y-auto">
                        {{ $report->description }}
                    </div>

                    <div class="col-span-2 text-green-700 font-mono">
                        {{ $report->car_number }}
                    </div>

                    <div class="col-span-3">
                        @if($report->status->name === 'новое')
                            <form class="status-form" action="{{ route('reports.status.update', $report->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status_id" id="status_id"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm border p-2 bg-white cursor-pointer">
                                    
                                    <option value="" disabled selected>Выберите статус...</option>
                                    
                                    @foreach($statuses as $status)
                                        @if($status->name === 'подтверждено' || $status->name === 'отклонено')
                                            <option value="{{ $status->id }}">
                                                {{ $status->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                {{ $report->status->name === 'подтверждено' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $report->status->name }}
                            </span>
                        @endif
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>