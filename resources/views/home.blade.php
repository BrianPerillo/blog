<head>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog
            </h2>
        </x-slot>

    <div class="m-5">

        @php
            $tipo = 'success';
            $alert = 'alert2';
        @endphp

        <x-alert :tipo="$tipo" class="mb-1"/> <!-- Dado que estas x-alert simples no pasan un title como las otras con el x-slot, en el constructor de Alert se puso uno por defecto-->
        <!-- Pasamos class para hacer un ejemplo de merge, de combinar la class que se le pasa por acá con la que ya tenía x defecto en la view del component-->
        <!-- La ventaja de no pasarselo a la clase es que podemos aplicarle ese atributo a un solo elemento x-alert y no a todos-->
        <x-alert />

        <x-alert tipo={{$tipo}} signo="!"> <!-- Ejemplo de como usar un attribute sin pasarselo a la clase - Esto me sirve para que un solo elemento tenga-->
            <x-slot name='title'>          <!-- el signo y no los demás, en cambio tipo y title es algo que comparten todos-->
                Título Warning
            </x-slot>

            Mensaje de alerta éxito
        </x-alert>

        <x-alert caracter="@">
            <x-slot name='title'>
                Título Primary
            </x-slot>

            Mensaje de alerta primario
        </x-alert>

        <!-- Alerta dinámico -->
        <x-dynamic-component :component="$alert"> <!-- Si cambiamos mas arriba el valor de esta variable a alert veremos como muestra otra cosa-->
            <x-slot name='title'>
                Título Primary
            </x-slot>

            Mensaje de alerta
        </x-alert>
        </x-app-layout>

    </div>