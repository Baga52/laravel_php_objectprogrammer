<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Создать заявление') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    
                    <h1 class="text-3xl font-bold text-gray-100 mb-2">НАРУШЕНИЙ.НЕТ</h1>
                    <h2 class="text-xl text-gray-300 mb-6">Новое заявление</h2>
                    
                    <form method="POST" action="{{ route('reports.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="car_number" class="block text-sm font-medium text-gray-300 mb-2">
                                Номер автомобиля:
                            </label>
                            <input 
                                type="text" 
                                name="car_number" 
                                id="car_number"
                                required
                                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            >
                        </div>
                        
                        <div class="mb-6">
                            <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                                Описание:
                            </label>
                            <textarea 
                                name="description" 
                                id="description"
                                rows="5"
                                required
                                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            ></textarea>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <button 
                                type="submit" 
                                class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                Создать
                            </button>
                            
                            <a 
                                href="{{ route('reports.index') }}" 
                                class="text-gray-300 hover:text-gray-100 transition font-medium"
                            >
                                Отмена
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>