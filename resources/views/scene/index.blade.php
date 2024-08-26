@extends('layout.app')

@section('content')
    <main class="h-[75vh] aspect-square bg-white rounded-2xl p-12 flex flex-col gap-12 shadow drop-shadow-lg">
        <h1 class="text-5xl text-center" id="title">Title</h1>
        <h5 class="text-lg text-center mb-6" id="description">Description</h5>
        <div id="children" class="grid grid-cols-3 gap-4"></div>
    </main>

    <script>
        let title = document.getElementById('title');
        let description = document.getElementById('description')
        let children = document.getElementById('children')

        function displayData(data)
        {
            children.textContent = '';
            title.textContent = data.scene.title
            description.textContent = data.scene.description

            data.children.forEach((scene) => {
                let child = document.createElement('button')
                child.classList.add('aspect-square', 'rounded-2xl', 'text-xl', 'bg-slate-50')
                child.textContent = scene.button

                child.addEventListener('click', function (e) {
                    e.preventDefault()
                    newData(scene.id)
                })

                children.appendChild(child)
            })

            if(data.redirect){
                let child = document.createElement('button')
                child.classList.add('aspect-square', 'rounded-2xl', 'text-xl', 'bg-slate-50')
                child.textContent = data.scene.button_redirect

                child.addEventListener('click', function (e) {
                    e.preventDefault()
                    newData(data.redirect.id)
                })

                children.appendChild(child)
            }

            if(!data.redirect && data.children.length < 1) {
                console.log('you won')
                setTimeout(function(){
                    newData(1);
                }, 2000);
            }
        }

        function newData(scene = 1)
        {
            var url = "{{ route('scene.show', ':scene') }}";
            url = url.replace(':scene', scene);

            $.ajax({
                'url': url,
                'method': "GET",
                'contentType': 'application/json'
            }).done(function(data) {
                console.log(data)
                displayData(data)
            });
        }

        newData()
    </script>
@endsection
