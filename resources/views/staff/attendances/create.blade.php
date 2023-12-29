<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto bg-white rounded p-6">
            <h2 class="text-xl font-semibold mb-6">Attendance Management</h2>

            @if ($userHasRegisteredAttendance)
                <p class="text-red-500 mb-6">You have already registered your attendance for the day.</p>
            @else
                <form method="post" action="{{ route('staff.attendances.store') }}" class="px-6 pb-6">
                    @csrf

                    <div class="pb-4">
                        <label for="action" class="block text-gray-700">Select Action:</label>
                        <select name="action" id="action" class="form-select mt-1 block w-full">
                            <option value="clock_in">Clock In</option>
                            <option value="clock_out">Clock Out</option>
                        </select>
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
