<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Список заявок
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-5 px-6">
          
                @forelse ($applications as $app)
                <p> {{ $app-> name }}</p>
                <p>{{ $app-> description }}</p>
                <hr>
                @empty
                <p>Заявок нет, и славо богу</p>
                @endforelse
            
            </div>
        </div>
    </div>
</x-app-layout>
