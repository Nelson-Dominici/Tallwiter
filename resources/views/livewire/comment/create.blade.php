<div class='mt-4'>

    <form wire:submit='create' class='flex items-center justify-center'>

        <div class='w-full'>
            <x-input required wire:model='text' placeholder='Write a comment!!!' class='py-2 placeholder:text-lg'/>
        </div>

        <x-button type='submit' wire:loading.class='bg-sky-900' wire:target='create' class='h-10 focus:!ring-0 mt-1 bg-primary text-white ml-4' icon='paper-airplane'/>

    </form>

</div>
