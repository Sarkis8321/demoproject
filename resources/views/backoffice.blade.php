<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Панель запросов
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-5 px-6">
                
            <form action="{{ route('backoffice-addapp') }}" method="post">
                @csrf
                <h2>Добавить заявку</h2>
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <input type="text" name="title" id="title" autocomplete="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="название...">
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <textarea name="description" id="description" autocomplete="description" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="описание..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                            <select name="cat_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @forelse ($allcat as $cat)
                                    <option value="{{ $cat -> id }}">{{ $cat -> name }}</option>
                                @empty
                                    <option value="0">Без категории</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>

            <div>
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
    </div>

</x-app-layout>