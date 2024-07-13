<div
    class='flex h-full'

    x-data='{
        limitRows: function(event) {

            let currentLines = this.$el.value.split("\n").length;

            if (event.keyCode == 13 && currentLines == 7) {

                event.preventDefault();
            }
        }
    }'
>
    <x-ui.menu/>

    <div class='border-r w-[600px]'>

        <div class='flex text-secondary w-full border-b justify-around items-end pt-4'>

            <a wire:navigate href='{{ route("home", ["filter" => "for-you"]) }}' class="{{ request('filter') !== 'following' ? 'border-b-4 border-primary' : 'mb-1' }} pb-2 cursor-pointer">
                For you
            </a>

            <a wire:navigate href='{{ route("home", ["filter" => "following"]) }}' class="{{ request('filter') == 'following' ? 'border-b-4 border-primary' : 'mb-1' }} pb-2 cursor-pointer">
                Following
            </a>

        </div>

        <form wire:submit='savePost' class='flex h-fit border-b p-5'>

            <div class='w-10 h-10 bg-primary mt-1 rounded-full flex items-center justify-center mr-4'>

                <p class='text-white font-bold text-lg'>
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </p>

            </div>

            <div class='grow'>

                <x-textarea @keydown='limitRows($event)' required wire:model='text' resize-auto maxlength='255' class='py-2 resize-none h-10 overflow-hidden placeholder:text-lg' placeholder='What is happening?!' />

                <div class='flex items-center mt-4 justify-between'>

                    <div class='flex items-center'>

                        <x-upload wire:model='photo'/>

                        <x-checkbox wire:model='only_followers' label='Only followers can see' class='ml-7 cursor-pointer'/>

                    </div>

                    <x-button type="submit" wire:loading.class='bg-sky-900' round class='focus:!ring-0 text-white font-bold text-base h-9 bg-primary'>
                        Post
                    </x-button>

                </div>

            </div>

        </form>

        @foreach ($posts as $post)

            <div class='w-full p-5 border-b'>

                <p class='break-words text-secondary'> {!! $post->text !!} </p>

            </div>

        @endforeach

    </div>

</div>
