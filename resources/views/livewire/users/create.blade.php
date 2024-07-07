<div class='flex w-full h-full items-center justify-center'>

    <form wire:submit='save' class='px-6 flex flex-col items-center justify-center phone:w-96 w-full'>

        <img class="w-44 mb-1" src="{{asset('/images/logo.png')}}">

        <div class='w-full mb-4'>
            <x-input required label='Name *' hint='Insert a name' wire:model='name' class='h-10'/>
        </div>

        <div class='w-full mb-4'>
            <x-input required label='Email *' hint='Insert a valid email' wire:model='email' class='h-10'/>
        </div>

        <div class='w-full mb-4'>
            <x-input required label='Password *' hint='Choose a password with at least 6 characters' wire:model='password' class='h-10'/>
        </div>

        <x-button type='submit' class='focus:!ring-0 text-white font-semibold text-xl phone:w-60 w-full p-3 bg-primary' wire:loading.class='opacity-75' round>
            Create
        </x-button>

        <p class='mt-6 font-semibold text-commonTextColor'>
            Do you already have an <a wire:navigate class='text-primary' href='{{ route("auth.login")}}'>account</a> ?
        </p>

    </form>

</div>
