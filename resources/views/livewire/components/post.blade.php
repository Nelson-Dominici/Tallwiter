<div wire:loading.class='opacity-40 bg-gray-200' wire:target='delete()' class='transition-all w-full p-5 border-b flex' x-data='{
    openComments: false,
}'>
    <div class='!w-10 !h-10 bg-primary mt-1 rounded-full flex items-center justify-center mr-4'>

        <p class='text-white font-bold text-lg'>
            {{
                strtoupper( substr($post->user->name, 0, 1) )
            }}
        </p>

    </div>

    <div class='grow w-min'>

        <div class='flex justify-between'>
            <h3 class='font-semibold text-secondary'>{{$post->user->name}}</h3>

            @if ($post->user_id == auth()->user()->id)
                <x-dropdown icon="ellipsis-vertical" static>
                    <x-dropdown.items wire:click='delete()' class='text-red-500' text='Delete' />
                </x-dropdown>
            @endif

        </div>

        <p class='break-all text-secondary'> {!! $post->text !!} </p>

        @if ($post->img_secure_url)
            <img src='{{$post->img_secure_url}}' class='center mx-auto mt-2 border rounded-lg max-h-72'>
        @endif

        <div class='mt-5 flex justify-around'>

            <div @click='openComments = !openComments' :class="openComments ? 'text-emerald-500' : 'text-slate-500'" class='transition-all flex cursor-pointer  hover:text-emerald-500'>
                <x-heroicon-o-chat-bubble-oval-left class='w-5 mr-1'/>
                <span>{{$comments_count}}</span>
            </div>

            <div wire:click='handleLike({{$post->id}})' class='{{ $liked ? "text-red-500" : "text-slate-500" }} transition-all flex cursor-pointer active:text-red-200'>
                <x-heroicon-o-heart class='w-5 mr-1'/>
                <span>{{$likes_count}}</span>
            </div>

            <div wire:click='handleBookMarke({{$post->id}})' class='{{ $marked ? "text-sky-500" : "text-slate-600" }} transition-all flex cursor-pointer active:text-sky-200'>
                <x-heroicon-o-bookmark class='w-5'/>
            </div>

        </div>

        <livewire:comment.index :$post/>

    </div>

</div>
