<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Список заявок
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-5 px-6">
            {{ csrf_field() }}
                @forelse ($applications as $app)
                <div class="mb-4 flex" >
                    <p> {{ $app-> name }}</p>
                    <p>{{ $app-> description }}</p>
                    @if ($app->status == '0')
                        <input type="checkbox" onchange="checkAppSatus(checked, {{ $app->id }})">
                    @else
                        <input type="checkbox" checked onchange="checkAppSatus(checked, {{ $app->id }})">
                    @endif
                </div>
                <hr>
                @empty
                <p>Заявок нет, и славо богу</p>
                @endforelse
            
            </div>
        </div>
    </div>

<script>

async function checkAppSatus(evt,id){
    
    let divpreload = document.createElement('div');
    divpreload.classList.add('bghover');
    let preload = document.createElement('img');
    preload.src='/img/load.gif';
    preload.classList.add('visible');
    divpreload.appendChild(preload);
    document.body.appendChild(divpreload);


    let responce = await fetch('/admin/updatestatus',{
        method:'POST',
        body: JSON.stringify({'id': id, 'status': evt}), 
        headers: {
             'Content-Type': 'application/json',
             'X-CSRF-Token':  document.querySelector('[name=_token]').getAttribute('value'),
             },

    }).then(res => res.json())
    .then(data => {
        console.log(data)
        document.body.removeChild(divpreload)
    });

} 

</script>

</x-app-layout>
