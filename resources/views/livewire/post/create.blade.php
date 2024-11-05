<div
    x-data='{
        limitRows: function(event) {

            let currentLines = this.$el.value.split("\n").length;

            if (event.keyCode == 13 && currentLines == 7) {

                event.preventDefault();
            }
        }
    }'
>
    <form wire:submit='create' class='flex h-fit border-b p-5'>

        <div class='hidden md:block size-11 bg-primary mt-1 rounded-full flex items-center justify-center mr-4 overflow-hidden'>

            @if(!auth()->user()->profile_photo_id)
                <p class='text-white font-bold text-lg'>
                    {{
                        strtoupper( substr(auth()->user()->name, 0, 1) )
                    }}
                </p>
            @else
                <x-cld-image public-id="{{auth()->user()->profile_photo_id}}" width="300" height="300" crop="scale"></x-cld-image>
            @endif

        </div>

        <div class='grow'>

            <x-textarea @keydown='limitRows($event)' required wire:model='text' resize-auto maxlength='255' class='py-2 resize-none h-10 overflow-hidden placeholder:text-lg' placeholder='What is happening?!' />

            <div class='flex items-center mt-4 justify-between'>

                <div class='flex items-center'>

                    <x-upload wire:model='photo'/>

                </div>

                <x-button type='submit' wire:loading.class='bg-sky-900' wire:target='create' round class='focus:!ring-0 text-white font-bold text-base h-9 bg-primary'>
                    Post
                </x-button>

            </div>

        </div>

    </form>

</div>
