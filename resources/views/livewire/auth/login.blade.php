<div class='flex w-full h-screen items-center justify-center'>

    <form wire:submit='login' class='px-6 flex flex-col items-center justify-center phone:w-96 w-full'>

        <img class="w-44 mb-1" src="{{asset('/images/logo.png')}}">

        <div class="w-full mb-4">
            <x-input required label="Email *" hint="Insert your email" wire:model='email' class="h-10"/>
        </div>

        <div class="w-full mb-4">
            <x-input required label="Password *" hint="Insert your password" wire:model='password' class="h-10"/>
        </div>

        <div class="mr-auto mb-4">
            <x-checkbox label='Remember me' wire:model='remember'/>
        </div>

        <x-button type="submit" class="focus:!ring-0 text-white font-semibold text-xl phone:w-60 w-full p-3 bg-primary" wire:loading.class="opacity-75" round>
            Enter
        </x-button>

        <p class="mt-5 font-semibold text-secondary">
            Don't have an <a wire:navigate class="text-primary decoration-1" href='{{ route("users.create") }}'>account</a>  yet?
        </p>

    </form>

</div>
