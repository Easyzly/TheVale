@extends('layout.app')

@section('content')
    <main class="h-[75vh] aspect-square rounded-2xl p-12 font-semibold text-black/90 flex flex-col gap-12 shadow drop-shadow-lg" style="background-size: cover; background-position: center; background-image: url('{{ asset('images/map.jpg') }}');">
        <h1 class="text-5xl text-center" id="title">The Vale</h1>
        <h5 class="text-lg text-center" id="description">Start the adventure of becomming a knight, king or lord.</h5>
        <div id="tooltipbox" class="tooltip text-center mb-6">Hover over me for a hint
            <span id="tooltiptext" class="tooltiptext"></span>
        </div>

        <div id="children" class="grid grid-cols-3 gap-4"></div>
        <p class="flex-grow"></p>
        <div class="grid grid-cols-3 gap-4">
            <button class="rounded-full p-2 backdrop-blur-3xl" id="restartStory">Restart</button>
            <button class="rounded-full p-2 backdrop-blur-3xl" id="saveStory">Save</button>
            <button class="rounded-full p-2 backdrop-blur-3xl" id="continueStory">Continue</button>
        </div>
    </main>

    <script>
        let title = document.getElementById('title');
        let description = document.getElementById('description')
        let children = document.getElementById('children')
        let hintText = document.getElementById('tooltiptext')
        let hintBox = document.getElementById('tooltipbox')
        let sceneVar = 1;

        document.getElementById('saveStory').addEventListener('click', function (e) {
            setCookie("scene", sceneVar, 7)
        })

        document.getElementById('restartStory').addEventListener('click', function (e) {
            deleteCookie('scene');
            mainMenu()
        })

        document.getElementById('continueStory').addEventListener('click', function (e) {
            newData(getCookie("scene") ?? 1)
        })

        function deleteCookie(name) {
            document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
        }

        function setCookie(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        function getCookie(name) {
            const nameEQ = name + "=";
            const cookies = document.cookie.split(';');
            for(let i = 0; i < cookies.length; i++) {
                let c = cookies[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function mainMenu(){
            title.textContent = 'The Vale';
            description.textContent = 'Start the adventure of becomming a knight, king or lord.';
            hintBox.style.visibility = "hidden"

            children.textContent = '';

            let startButton = document.createElement('button')
            startButton.textContent = 'Start';
            startButton.classList.add('p-8', 'rounded-2xl', 'text-3xl', 'backdrop-blur-3xl', 'col-span-3')
            children.append(startButton)
            startButton.addEventListener('click', function (e) {
                e.preventDefault()
                newData();
            })

            let helpButton = document.createElement('button')
            helpButton.textContent = 'Help';
            helpButton.classList.add('p-8', 'rounded-2xl', 'text-3xl', 'backdrop-blur-3xl', 'col-span-3')
            children.append(helpButton)
            helpButton.addEventListener('click', function (e) {
                e.preventDefault()
                helpMenu()
            })
        }

        function helpMenu(){
            children.textContent = '';
            hintBox.style.visibility = "hidden"

            let helpButton = document.createElement('button')
            helpButton.textContent = 'Main menu';
            helpButton.classList.add('p-8', 'rounded-2xl', 'text-3xl', 'backdrop-blur-3xl', 'col-span-3')
            children.append(helpButton)
            helpButton.addEventListener('click', function (e) {
                e.preventDefault()
                mainMenu()
            })

            let helps = [
                'Press the buttons/cards to advance in the story',
                'Stuck? you can always refresh the page to return to the main menu',
                'The goal is either becoming a knight, lord or king',
                'Made by: Jamie van Gulik - Laravel'
            ];

            helps.forEach((help) => {
                let controls = document.createElement('p')
                controls.textContent = help;
                controls.classList.add('px-8', 'py-4', 'rounded-2xl', 'text-xl', 'backdrop-blur-3xl', 'col-span-3')
                children.append(controls)
            })
        }

        mainMenu()

        function displayData(data)
        {
            children.textContent = '';
            title.textContent = data.scene.title
            description.textContent = data.scene.description
            hintText.textContent = data.help

            data.children.forEach((scene) => {
                let child = document.createElement('button')
                child.classList.add('aspect-square', 'rounded-2xl', 'text-xl', 'backdrop-blur-3xl')
                child.textContent = scene.button

                child.addEventListener('click', function (e) {
                    e.preventDefault()
                    newData(scene.id)
                })

                children.appendChild(child)
            })

            if(data.redirect){
                let child = document.createElement('button')
                child.classList.add('aspect-square', 'rounded-2xl', 'text-xl', 'backdrop-blur-3xl')
                child.textContent = data.scene.button_redirect

                child.addEventListener('click', function (e) {
                    e.preventDefault()
                    newData(data.redirect.id)
                })

                children.appendChild(child)
            }

            if(!data.redirect && data.children.length < 1) {
                let Button = document.createElement('button')
                Button.textContent = 'You won, start again!';
                Button.classList.add('p-8', 'rounded-2xl', 'text-3xl', 'backdrop-blur-3xl', 'col-span-3')
                children.append(Button)
                Button.addEventListener('click', function (e) {
                    e.preventDefault()
                    mainMenu()
                })
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
                hintBox.style.visibility = "visible"
                sceneVar = scene;
                displayData(data)
            });
        }
    </script>
@endsection
