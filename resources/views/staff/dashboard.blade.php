<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 items-center pb-3 gap-3">
                <div
                    class="flex items-center gap-x-6 gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                        <path fill-rule="evenodd"
                            d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-normal text-sm text-gray-700">Clocked-in</p>
                        <h5 class="text-3xl font-bold tracking-tight text-gray-900 ">
                            @if ($todayAttendances->isNotEmpty())
                                {{ $todayAttendances->first()->check_in_time }}
                            @else
                                <p class="text-sm">No attendance today</p>
                            @endif
                        </h5>
                    </div>
                </div>
                <div
                    class="flex items-center gap-x-6 gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                        <path fill-rule="evenodd"
                            d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-normal text-sm text-gray-700">Clocked-out</p>
                        <h5 class="text-3xl font-bold tracking-tight text-gray-900 ">
                            @if ($todayAttendances->isNotEmpty())
                                @if ($todayAttendances->first()->check_out_time !== null)
                                    {{ $todayAttendances->first()->check_out_time }}
                                @else
                                    <p class="text-sm">No attendance today</p>
                                @endif
                            @else
                                <p class="text-sm">No attendance today</p>
                            @endif
                        </h5>
                    </div>
                </div>
                <div
                    class="flex items-center gap-x-6 gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <div>
                        <p class="font-normal text-sm text-gray-700">Working Hours</p>
                        <h5 class="text-3xl font-bold tracking-tight text-gray-900">{{ $workingHours }} Hours</h5>
                    </div>
                </div>

                {{-- <div class="grid gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <p class="font-normal text-sm text-gray-700">Attendance Rate</p>
                    <h5 class="text-3xl font-bold tracking-tight text-gray-900 ">420</h5>
                </div> --}}
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white overflow-hidden shadow-sm rounded-lg ">
                    <div class="text-gray-900 text-base font-semibold px-4 py-3 border-b">
                        {{ __('Attendance') }}
                    </div>
                    <div class="text-gray-900 px-6 py-4">
                        <div class="flex flex-col gap-2  items-center">
                            <div id="date" class="font-bold text-xl"></div>
                            <div id="clock" class="font-bold text-xl"></div>
                        </div>
                        <div id="attendanceForm" class="pt-3">
                            @if ($userHasRegisteredAttendance)
                                <p class="text-green-600 font-semibold text-center">You have already registered your
                                    attendance for
                                    the day.
                                </p>
                            @else
                                <form method="post" action="{{ route('staff.attendances.store') }}">
                                    @csrf
                                    <div class="pb-4">
                                        <label for="action" class="block text-gray-700 pb-2 text-sm">Select
                                            Action:</label>
                                        <select name="action" id="action"
                                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="clock_in">Clock In</option>
                                            <option value="clock_out">Clock Out</option>
                                        </select>
                                    </div>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="max-w-7xl mx-auto flex flex-col gap-y-6">
                        <div class="relative overflow-x-auto sm:rounded-lg bg-white">
                            <div class="text-gray-900 text-base font-semibold px-4 py-3 border-b">
                                {{ __('My Leaves') }}
                            </div>
                            @if ($leaves->isEmpty())
                                <p class="text-gray-500 text-center py-4">No leave requests found.</p>
                            @else
                                <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                                    <thead class="text-xs text-gray-950 uppercase bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-6 py-3.5">Request Date</th>
                                            <th class="px-6 py-3.5">Details</th>
                                            <th class="px-6 py-3.5">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($leaves as $leave)
                                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                                <td class="px-6 py-4">{{ $leave->request_date }}</td>
                                                <td class="px-6 py-4">
                                                    {{ $leave->start_date }} - {{ $leave->end_date }},
                                                    @if ($leave->leave_type === 'annual')
                                                        Annual
                                                    @else
                                                        Sick
                                                    @endif
                                                    ({{ \Carbon\Carbon::parse($leave->start_date)->diffInDays($leave->end_date) }}
                                                    days)
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if ($leave->status === 'approved')
                                                        <span
                                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">Approved</span>
                                                    @elseif ($leave->status === 'rejected')
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-400">Rejected</span>
                                                    @else
                                                        <span
                                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-400">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const clockElement = document.getElementById('clock');
            const dateElement = document.getElementById('date');

            const currentTime = new Date();

            // Format the time as HH:MM:SS
            const formattedTime = currentTime.toLocaleTimeString();

            // Format the date as "Day, Month DD, YYYY"
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const formattedDate = currentTime.toLocaleDateString(undefined, options);

            // Update the clock and date elements
            clockElement.textContent = formattedTime;
            dateElement.textContent = formattedDate;
        }

        // Update the clock every second
        setInterval(updateClock, 1000);

        // Initial update
        updateClock();
    </script>
</x-app-layout>
