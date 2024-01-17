<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-6">
            <div class="flex justify-between items-center pt-10">
                <div class="text-gray-900 font-bold text-2xl">
                    {{ __('Attendance List') }}
                </div>
            </div>
            <div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg max-w-md mx-auto">
                    @if ($userHasRegisteredAttendance)
                        <p class="text-green-600 font-semibold text-center p-6">You have already registered your
                            attendance for
                            the day.
                        </p>
                    @else
                        <form method="post" action="{{ route('staff.attendances.store') }}" class="p-6">
                            @csrf
                            <div class="">
                                <label class="block text-gray-700 pb-2 font-bold">Select Action:</label>
                                <div class="flex gap-3">
                                    <button type="submit" name="action" value="clock_in"
                                        class="text-white text-lg flex flex-col items-center justify-center gap-y-2 font-bold bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg w-full px-5 py-2.5 text-center ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                        Clock In
                                    </button>
                                    <button type="submit" name="action" value="clock_out"
                                        class="text-white text-lg flex flex-col items-center justify-center gap-y-2 bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-lg w-full px-5 py-2.5 text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                                        </svg>
                                        Clock Out
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <div class="relative overflow-x-auto rounded-lg bg-white">
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative m-4">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="table-search"
                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-60 bg-white focus:ring-blue-500 focus:border-blue-500 "
                        placeholder="Search">
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                    <thead class="text-xs text-gray-950 uppercase bg-gray-50 border-b border-t border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Date</th>
                            <th class="px-6 py-3.5">Check-In Time</th>
                            <th class="px-6 py-3.5">Check-Out Time</th>
                            <th class="px-6 py-3.5">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $attendance->date }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_in_time }}</td>
                                <td class="px-6 py-4">
                                    @if ($attendance->check_out_time !== null)
                                        {{ $attendance->check_out_time }}
                                    @else
                                        <p>Haven't clocked out yet.</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($attendance->status === 'present')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">Present</span>
                                    @else
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-400">Late</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Add pagination if needed -->
                <div class="py-4 px-6">
                    {{-- {{ $attendances->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
