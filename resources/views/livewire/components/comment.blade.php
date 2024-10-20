<div class='mt-4 flex'
    x-data='{
        deletComment: function() {
            const comment = this.$el.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;

            comment.classList.add("opacity-30");

            this.$wire.delete().then(() => {
                comment.classList.add("hidden");
            });
        }
    }'
>
    <a wire:navigate href="{{ '/users/profile/' . $post->user->id }}"  class='w-10 h-10 bg-primary mt-1 rounded-full flex items-center justify-center mr-4 overflow-hidden'>

        @if($this->profile_photo_id)
            <x-cld-image public-id="{{$comment['profile_photo_id']}}" width="300" height="300" crop="scale"></x-cld-image>
        @else
            <p class='text-white font-bold text-lg'>
                {{
                    strtoupper( substr($comment['name'], 0, 1) )
                }}
            </p>
        @endif

    </a>

    <div class='grow w-min'>

        <div class='flex justify-between'>
            <a wire:navigate href="{{ '/users/profile/' . $post->user->id }}"  class='font-semibold text-secondary'>
                {{$comment['name']}}
            </a>

            @if ($comment['user_id'] == auth()->user()->id)
                <x-dropdown icon="ellipsis-vertical" static>
                    <x-dropdown.items @click='deletComment()' class='text-red-500' text='Delete' />
                </x-dropdown>
            @endif

        </div>

        <p class='break-all text-secondary'> {!! $comment['text'] !!} </p>

        <div wire:click='handleLike({{$post->id}})' class='{{ $liked ? "text-red-500" : "text-slate-500" }} w-fit transition-all flex cursor-pointer active:text-red-200 mt-2'>
            <x-heroicon-o-heart class='w-5 mr-1'/>
            <span>{{$likes_count}}</span>
        </div>

    </div>

</div>
