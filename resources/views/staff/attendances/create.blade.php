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
                    <p class="text-green-600 font-semibold text-center">You have already registered your
                        attendance for
                        the day.
                    </p>
                @else
                    <form method="post" action="{{ route('staff.attendances.store') }}" class="p-6">
                        @csrf

                        <div class="pb-4">
                            <label class="block text-gray-700 pb-2 font-bold">Select Action:</label>
                            <div class="flex flex-col gap-3">
                                <button type="submit" name="action" value="clock_in"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center ">
                                    Clock In
                                </button>
                                <button type="submit" name="action" value="clock_out"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center">
                                    Clock Out
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
