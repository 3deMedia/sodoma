<x-app-layout>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>FAILURE PAGE</p>
                    <x-dash-panel-tabs :profile="$user_profile" :user-type="$user_type" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
