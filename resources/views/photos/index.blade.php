<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Photo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:upload-photo-livewire />

                    <!-- Success One -->
                    @if (session('successone'))
                        <div class="grid grid-cols-12 gap-6 mt-4 mb-2">
                            <div class="col-span-12">
                                <div
                                    x-data="{ isOpen: true }"
                                    x-show="isOpen"
                                    x-init="setTimeout(() => {
                                    isOpen = false
                                }, 7000)"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform translate-x-0"
                                    x-transition:leave-end="opacity-0 transform translate-x-8"
                                    @keydown.escape.window="isOpen = false">
                                    <div class="border border-lime-600 p-2 mb-2 rounded-lg">
                                        <p class="font-medium text-slate-800 text-xs text-center">{{ session("successone") }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- ../Success One -->

                    <!-- Success Two -->
                    @if (session('successtwo'))
                        <div class="grid grid-cols-12 gap-6 mt-4 mb-2">
                            <div class="col-span-8">
                                <div
                                    x-data="{ isOpen: true }"
                                    x-show="isOpen"
                                    x-init="setTimeout(() => {
                                    isOpen = false
                                }, 7000)"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 transform translate-x-0"
                                    x-transition:leave-end="opacity-0 transform translate-x-8"
                                    @keydown.escape.window="isOpen = false">
                                    <div class="border border-lime-600 p-2 mb-2 rounded-lg">
                                        <p class="font-medium text-slate-800 text-xs text-center">{{ session("successtwo") }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!-- ../Success Two -->

                </div>

                <!-- Save image -->
                @include('includes.save-image')
                <!-- Save image -->

            </div>
        </div>
    </div>
</x-app-layout>
