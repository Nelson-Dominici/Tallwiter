<div class='flex w-full'>

    <livewire:components.menu/>

    <div class='border-r w-[600px] min-h-screen	h-fit'>

        <section class='h-48 bg-primary bg-slate-300 relative'>

            <div class='absolute -bottom-20 left-5 h-36 w-36 bg-secondary border-4 border-white border-white-600 rounded-full'></div>

        </section>

        <div class='pl-4 relative pt-24'>

            <x-button text="Edit Profile" outline class='absolute right-3 top-3' x-on:click="$modalOpen('modal-id')"/>

            <h1 class='text-2xl font-semibold'>Nelson Dominici</h1>

            <p class='mt-2 mb-4'>isso é uma descrição. isso é uma descrição. isso é uma descrição. isso é uma descrição. isso é uma descrição.</p>

            <div class='flex'>
                <x-icon name='envelope' class='h-5 w-5 text-slate-500'>
                    <x-slot:right>
                        <p class='text-slate-500 mr-4'>nelsoncomer@gmail.com</p>
                    </x-slot:right>
                </x-icon>

                <x-icon name="calendar-days" class='h-5 w-5 text-slate-500'>
                    <x-slot:right>
                        <p class='text-slate-500'>20/12/2025</p>
                    </x-slot:right>
                </x-icon>
            </div>


        </div>

    </div>

    <x-modal id="modal-id">

        <form action="">
            <div>
                <x-input label="Name" hint="Insert your name" />
            </div>

            <div class='mt-3'>
                <x-input label="Description" hint="Tell us about yourself" />
            </div>
        </form>

        <x-button x-on:click="$modalClose('modal-id')">
            Close
        </x-button>
    </x-modal>
</div>
