<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-6">
            <div class="flex justify-between items-center pt-10"">
                <div class="text-gray-900 text-3xl font-bold">
                    {{ __('Attendance List') }}
                </div>
                <form method="GET" action="{{ route('admin.attendances.index') }}" class="flex items-center gap-x-3">
                    @csrf
                    <label for="filter_date">Filter by Date:</label>
                    <input type="date" id="filter_date" name="filter_date" class="border rounded-md p-1">
                    <button type="submit" class="px-4 py-2 rounded-lg font-bold bg-green-600 text-white">Apply
                        Filter</button>
                </form>
                <button class="px-4 py-2 rounded-lg font-bold bg-green-600 text-white">
                    <a href=>New Attendance</a>
                </button>
            </div>
            <div class="relative overflow-x-auto sm:rounded-lg bg-white">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-20">
                    <li class="me-2">
                        <a href="#"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-600 hover:border-green-600">Today</a>
                    </li>
                    <li class="me-2">
                        <a href="#"
                            class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-green-600 hover:border-green-600">Here is for filtering</a>
                    </li>
                </ul>
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
                            <th class="px-6 py-3.5">No.</th>
                            <th class="px-6 py-3.5">User ID</th>
                            <th class="px-6 py-3.5">Check-In Time</th>
                            <th class="px-6 py-3.5">Check-Out Time</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todayAttendances as $attendance)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4">{{ $attendance->user->name }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_in_time }}</td>
                                <td class="px-6 py-4">{{ $attendance->check_out_time }}</td>
                                <td class="px-6 py-4">
                                    @if ($attendance->status === 'late')
                                        <span
                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-400">Late</span>
                                    @else
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">Present</span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 flex gap-x-3">
                                    <a href=""
                                        class="text-blue-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <!-- Your SVG path for Edit icon -->
                                        </svg>
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4"
                    aria-label="Table navigation">
                    {{ $attendances->links() }}
                </nav> --}}
            </div>
        </div>
    </div>
</x-app-layout>
