<x-app-layout>
    <div class="py-12">
        <div class="max-w-lg mx-auto px-8 flex flex-col gap-y-6">
            <div>
                <div class="text-gray-900 text-2xl font-bold pt-10">
                    {{ __('Attendance Management') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
</x-app-layout>
