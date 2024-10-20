<div class="md:w-80 pt-3 md:pl-10 border-r px-10 flex justify-center md:justify-normal">

    <div class='fixed'>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2" wire:navigate href='/home'>
            <img class="w-9 h-9" src="{{asset('/images/logo-icon.png')}}">
        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href='/home'>

            @if ($selectButton == 'home')
                <x-heroicon-m-home class="w-8 text-secondary"/>
            @else
                <x-heroicon-o-home class="w-8 text-secondary"/>
            @endif

            <p class="md:block hidden ml-5 text-xl text-secondary">Home</p>

        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href="{{ route('notifications') }}">

            @if (Route::currentRouteName() == 'notifications')
                <x-heroicon-c-bell class="w-8 text-secondary"/>
            @else

                <div class="relative">
                    <x-heroicon-o-bell class="w-8 text-secondary"/>

                    @if (auth()->user()->notification)
                        <div class="size-3 absolute top-0 left-8 rounded-full mb-4 -ml-1 bg-primary"></div>
                    @endif

                </div>

            @endif

            <p class="md:block hidden ml-5 text-xl text-secondary">Notifications</p>
        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href="{{ '/users/profile/' . auth()->user()->id }}">

            @if (Str::is('users/profile/*', $selectButton))
                <x-heroicon-c-user class='w-8 text-secondary'/>
            @else
                <x-heroicon-o-user class='w-8 text-secondary'/>
            @endif

            <p class="md:block hidden ml-5 text-xl text-secondary">Profile</p>
        </a>

        <a class="flex items-center hover:bg-[#EEEEEE] rounded-full transition-all w-fit p-2 mt-2 pr-3" wire:navigate href="{{ route('bookmarks') }}">

            @if (Route::currentRouteName() == 'bookmarks')
                <x-heroicon-c-bookmark class='w-8 text-secondary'/>
            @else
                <x-heroicon-o-bookmark class='w-8 text-secondary'/>
            @endif

            <p class="md:block hidden ml-5 text-xl text-secondary">Bookmarks</p>
        </a>

    </div>

</div>
