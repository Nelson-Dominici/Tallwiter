<div class='flex w-full'>

    <livewire:components.menu/>

    <div class='border-r w-[600px] min-h-screen	h-fit flex flex-col relative '>

        <section class='h-48 bg-primary bg-slate-300 overflow-hidden'>

            @if($this->banner_photo_id)
                <x-cld-image public-id="{{$this->banner_photo_id}}" crop="crop" gravity="faces"></x-cld-image>
            @endif

        </section>

        <div class='overflow-hidden	absolute top-32 left-5 size-36 bg-primary border-4 border-white border-white-600 rounded-full flex justify-center items-center'>

            @if(!$this->profile_photo_id)
                <h1 class='text-white text-6xl font-semibold'>
                    {{ strtoupper( substr($this->name, 0, 1) ) }}
                </h1>
            @else
                <x-cld-image public-id="{{$this->profile_photo_id}}" width="300" height="300" crop="scale"></x-cld-image>
            @endif

        </div>

        <div class='pl-4 relative pt-24'>

            @if(auth()->user()->id == $this->profileUserId)
                <x-button text='Edit Profile' class='absolute right-3 top-3 bg-primary text-white font-bold' x-on:click="$modalOpen('modal-id')"/>
            @else
                <x-button text='{{ $this->following ? "Unfollow" : "Follow" }}' wire:click='followHandle' class='absolute right-3 top-3 bg-primary text-white font-bold'/>
            @endif

            <h1 class='text-2xl font-semibold text-secondary'>{{$this->name}}</h1>

            <p class='mt-2 mb-4 text-slate-500'>
                {{ $this->description ? $this->description : "Hello, I'm using Tallwiter" }}
            </p>

            <div class='flex'>
                <x-icon name='envelope' class='h-5 w-5 text-slate-500'>
                    <x-slot:right>
                        <p class='text-slate-500 mr-4'>{{$this->email}}</p>
                    </x-slot:right>
                </x-icon>

                <x-icon name='calendar-days' class='h-5 w-5 text-slate-500'>
                    <x-slot:right>
                        <p class='text-slate-500'>{{ \Carbon\Carbon::parse($this->created_at)->format('d/m/Y') }}</p>
                    </x-slot:right>
                </x-icon>
            </div>

            <h1 class="mt-4 text-slate-500 font-semibold font-normal">
                <span class="text-secondary">{{$this->followersCount}}</span> follow
            </h1>

        </div>

        <div class='border-t mt-5 min-h-72 h-fit pt-3'>

            <h1 class='mx-auto border-b-4 border-primary w-fit text-center font-bold text-secondary'>posts</h1>

            @foreach ($posts as $post)

                <livewire:components.post :$post :key='$post->id'/>

            @endforeach

            @if (!$posts->toArray())
                <x-heroicon-o-archive-box class="w-24 mx-auto mt-12 text-slate-500"/>
                <h1 class="text-slate-500 text-xl font-bold text-center">
                    {{auth()->user()->id == $this->profileUserId ? "You haven't marked any posts" : "This user hasn't marked any posts"}}
                </h1>
            @endif

        </div>

        <div class='px-4 py-3 mt-auto border-t'>

            <x-icon name="user" class="h-5 w-5 text-slate-500">
                <x-slot:right>
                    <h1 class='font-bold text-slate-500 text-lg'>Logut</h1>
                </x-slot:right>
            </x-icon>

            <p class='text-slate-500'>Press the button to log out of your current account.</p>

            <div class='flex mt-3'>
                <x-button outline wire:click='logout' text="Logout" color="sky" wire:loading.class='bg-sky-900' wire:target='logout' class='ml-auto focus:!ring-0  w-40'/>
            </div>

        </div>

        <div class='px-4 border-y py-2'>

            <x-icon name="exclamation-circle" class="h-5 w-5 text-slate-500">
                <x-slot:right>
                    <h1 class='font-bold text-slate-500 text-lg'>Delete Account</h1>
                </x-slot:right>
            </x-icon>

            <p class='text-slate-500'>Press the button to permanently delete your Tallwiter account.</p>

            <div class='flex mt-3'>
                <x-button outline wire:click='delete' text="Delete" color="red" wire:loading.class='bg-sky-900' wire:target='delete' class='ml-auto focus:!ring-0  w-40'/>
            </div>

        </div>

    </div>

    <x-modal id='modal-id' class='relative' wire>

        <form wire:submit='save'>

            <div class='mt-3'>
                <x-upload required wire:model='profilePhoto' label='Profile photo' hint='Choose your profile picture' tip="Drag and drop your screenshot here" />
            </div>

            <div class='mt-3'>
                <x-upload required wire:model='bannerPhoto' label='Banner photo' hint='Choose your banner picture' tip='Drag and drop your screenshot here' />
            </div>

            <div class='mt-3'>
                <x-input required label='Name' wire:model='name' hint='Insert your name' />
            </div>

            <div class='mt-3'>
                <x-input label='Description' wire:model='description' hint='Tell us about yourself'/>
            </div>

            <div class='ml-auto w-fit'>
                <x-button type='submit' wire:loading.class='bg-sky-900' text="Save" color="green"/>
            </div>

        </form>

        <x-button class='absolute top-0 right-1' x-on:click="$modalClose('modal-id')">
            <span class='text-xl font-bold'>x</span>
        </x-button>

    </x-modal>
</div>
