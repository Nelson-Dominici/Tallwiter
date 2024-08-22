<div class="w-80 pt-3 pl-10 border-r">

    <div class='fixed'>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2" wire:navigate href='/home'>
            <img class="w-9 h-9" src="{{asset('/images/logo-icon.png')}}">
        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href='/home'>

            @if ($selectButton == 'home')
                <x-heroicon-c-home class="w-8 text-secondary"/>
            @else
                <x-heroicon-o-home class="w-8 text-secondary"/>
            @endif

            <p class="ml-5 text-xl text-secondary">Home</p>

        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href="{{ route('home', ['filter' => 'for-you']) }}">
            <x-heroicon-o-bell class="w-8 text-secondary"/>

            <p class="ml-5 text-xl text-secondary">Notifications</p>
        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href='/users/edit'>

            @if ($selectButton == 'users/edit')
                <x-heroicon-c-user class='w-8 text-secondary'/>
            @else
                <x-heroicon-o-user class='w-8 text-secondary'/>
            @endif

            <p class="ml-5 text-xl text-secondary">Profile</p>
        </a>

    </div>

</div>
