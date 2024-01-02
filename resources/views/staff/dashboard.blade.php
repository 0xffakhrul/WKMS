<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900 font-bold text-xl">
                        <div id="clock"></div>
                        <div id="attendanceForm">
                            @if ($userHasRegisteredAttendance)
                                <p class="text-red-500 p-6">You have already registered your attendance for the day.</p>
                            @else
                                <form method="post" action="{{ route('staff.attendances.store') }}" class="p-6">
                                    @csrf
                                    <div class="pb-4">
                                        <label for="action" class="block text-gray-700">Select Action:</label>
                                        <select name="action" id="action"
                                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
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
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="p-6 text-gray-900">
                        {{ __('Staff') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const clockElement = document.getElementById('clock');
            const currentTime = new Date();

            // Format the time as HH:MM:SS
            const formattedTime = currentTime.toLocaleTimeString();

            // Update the clock element
            clockElement.textContent = formattedTime;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial update
        updateClock();
    </script>
</x-app-layout>
