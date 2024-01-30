
                <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Панель Администратора
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-5 px-6">
            <form action="{{ route('admin-addcategory') }}" method="post">
                @csrf
                <h2>Добавить категорию</h2>
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <div class="mt-2">
                        <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                        <input type="text" name="catname" id="catname" autocomplete="catname" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="название...">
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                </div>
            </form>

            

            </div>
        </div>

    
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-5 px-6 mt-6">
        <ul role="list" class="divide-y divide-gray-100">
            

        @forelse ($allcat as $cat)
            <li class="flex justify-between gap-x-6 py-5" data="{{ $cat->id }}">
                <div class="flex min-w-0 gap-x-4">
                <div class="min-w-0 flex-auto">
                    <p class="text-sm font-semibold leading-6 text-gray-900">{{ $cat->name }}</p>
                </div>
                </div>
                <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                <p class="mt-1 text-xs leading-5 text-gray-500"><time datetime="">{{ $cat->created_at }}</time></p>
                </div>
                
                <button data="{{ $cat->id }}" type="submit" class="btn-del rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Удалить</button>
            </li>
         @empty
         <li class="flex justify-between gap-x-6 py-5">
                <div class="flex min-w-0 gap-x-4">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-gray-900">Категорий нет</p>
                    </div>
                </div>
            </li>
        @endforelse

        </ul>
    </div>
</div>
    
<script>

let btnDels = document.querySelectorAll('.btn-del')
btnDels.forEach(el => {
    el.addEventListener('click', async (evt) => {
        let isDel = confirm("Вы действительно хотите удалить категорию?");
        if (isDel) {
            let id = evt.target.attributes.data.textContent;
            let responce = await fetch('/admin/deletecat/'+ id)
            .then(res => res.json())
            .then(data => {
                if (!data.isErr){
                    evt.target.parentNode.parentNode.removeChild(evt.target.parentNode);
                    alert(data.text);
                } else {
                    alert(data.text);
                } 
            });
        }
    })
})

</script>

</x-app-layout>