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

            <div id="all-apps">
                @forelse ($applications as $app)
                <div class="mb-4" data-status="{{ $app->status }}" data-id="{{ $app->id }}">
                    <p> {{ $app-> name }}</p> 
                    <p>{{ $app-> description }}</p>
                        <div class="inputs">
                            <label for="new">новая</label>
                            <input type="radio" id="new" data-code="0" name="{{ $app->id }}">
                            <label for="review">На рассмотрении</label>
                            <input type="radio" id="review" data-code="1" name="{{ $app->id }}">
                            <label for="ok">Принято</label>
                            <input type="radio" id="ok" data-code="2" name="{{ $app->id }}">
                            <label for="nook">Отклонено</label>
                            <input type="radio" id="nook" data-code="3" name="{{ $app->id }}">
                        </div>
                </div>
                <hr>
                @empty
                <p>Заявок нет, и славо богу</p>
                @endforelse
            </div>

            </div>
        </div>
    </div>

<script>

let allApps = document.querySelectorAll('[data-status]')
 
allApps.forEach(el => {
    let ds = el.getAttribute("data-status")
    let di = el.getAttribute("data-id")
    el.querySelector('.inputs').querySelectorAll('input')[ds].checked=true;
    el.addEventListener('change', (e)=>{
        if(e.target.tagName == 'INPUT'){
            checkAppSatus(e.target.getAttribute('data-code'), e.target.parentNode.parentNode.getAttribute('data-id'))
        }
    })
});




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
