<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 items-center pb-6 gap-3">
                <div
                    class="flex items-center gap-x-6 gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>
                    <div>
                        <p class="font-normal text-sm text-gray-700">Employees</p>
                        <h5 class="text-3xl font-bold tracking-tight text-gray-900 ">{{ $users->count() }}</h5>
                    </div>
                </div>
                <div
                    class="flex items-center gap-x-6 gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-12 h-12">
                        <path fill-rule="evenodd"
                            d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <p class="font-normal text-sm text-gray-700">Pending Leave Requests</p>
                        <h5 class="text-3xl font-bold tracking-tight text-gray-900 ">{{ $leaves->count() }}</h5>
                    </div>
                </div>
                <div class="grid gap-y-1 max-w-sm px-6 py-5 bg-white border border-gray-200 rounded-lg">
                    <p class="font-normal text-sm text-gray-700">Attendance Rate</p>
                    <h5 class="text-3xl font-bold tracking-tight text-gray-900 ">420</h5>
                </div>
            </div>
            <div class="">
                <div class="max-w-7xl mx-auto flex flex-col gap-y-6">
                    <div class="relative overflow-x-auto sm:rounded-lg bg-white">
                        <div class="text-gray-900 text-base font-semibold px-4 py-3 border-b">
                            {{ __('Latest Employees') }}
                        </div>
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative m-4">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-60 bg-white focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Search" />
                        </div>
                        @if ($users->isEmpty())
                            <p class="text-gray-500 text-center py-4">No employees found.</p>
                        @else
                            <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                                <thead
                                    class="text-xs text-gray-950 uppercase bg-gray-50 border-b border-t border-gray-200">
                                    <tr>
                                        <th class="px-6 py-3.5">No.</th>
                                        <th class="px-6 py-3.5">Name</th>
                                        <th class="px-6 py-3.5">Email</th>
                                        <th class="px-6 py-3.5">Phone No.</th>
                                        <th class="px-6 py-3.5">Role</th>
                                        <th class="px-6 py-3.5">Employment Type</th>
                                        <th class="px-6 py-3.5"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users->sortByDesc('created_at')->take(5) as $user)
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                            <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                                            <td class="px-6 py-4">{{ $user->name }}</td>
                                            <td class="px-6 py-4">{{ $user->email }}</td>
                                            <td class="px-6 py-4">{{ $user->phone_number }}</td>
                                            <td class="px-6 py-4">
                                                @if ($user->role == 1)
                                                    Admin
                                                @elseif($user->role == 2)
                                                    Employee
                                                @else
                                                    {{ $user->role }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                @if ($user->type === 'full_time')
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-400">Full-Time</span>
                                                @elseif ($user->type === 'part_time')
                                                    <span
                                                        class="bg-orange-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded border border-orange-400">Part-Time</span>
                                                @else
                                                    <span
                                                        class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded border border-gray-400">Unknown</span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4 flex gap-x-3">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="font-semibold text-blue-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-x-6">
                    <div class="flex flex-col gap-y-6 pt-7">
                        <div class="relative overflow-x-auto sm:rounded-lg bg-white">
                            <div class="text-gray-900 text-base font-semibold px-4 py-3 border-b">
                                {{ __('Today\'s Attendance') }}
                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative m-4">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-950" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-60 bg-white focus:ring-blue-500 focus:border-blue-500 "
                                    placeholder="Search">
                            </div>
                            @if ($todayAttendances->isEmpty())
                                <p class="text-gray-500 text-center py-4">No attendance records found.</p>
                            @else
                                <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                                    <thead
                                        class="text-xs text-gray-950 uppercase bg-gray-50 border-b border-t border-gray-200">
                                        <tr>
                                            <th class="px-6 py-3.5">No.</th>
                                            <th class="px-6 py-3.5">Name</th>
                                            <th class="px-6 py-3.5">Check In Time</th>
                                            <th class="px-6 py-3.5">Check Out Time</th>
                                            <th class="px-6 py-3.5">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($todayAttendances as $attendance)
                                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                                <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                                                <td class="px-6 py-4">{{ $attendance->user->name }}</td>
                                                <td class="px-6 py-4">{{ $attendance->check_in_time }}</td>
                                                <td class="px-6 py-4">
                                                    {{ $attendance->check_out_time ?: 'Not checked out' }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    @if ($attendance->status === 'late')
                                                        <span
                                                            class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded border border-red-400">Late</span>
                                                    @elseif ($attendance->status === 'present')
                                                        <span
                                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">Present</span>
                                                    @else
                                                        <span
                                                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded border border-blue-400">Default</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-6 pt-7">
                        <div class="relative overflow-x-auto sm:rounded-lg bg-white">
                            <div class="text-gray-900 text-base font-semibold px-4 py-3 border-b">
                                {{ __('Pending Leave Requests') }}
                            </div>
                            <label for="table-search" class="sr-only">Search</label>
                            <div class="relative m-4">
                                <div
                                    class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-950" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="text" id="table-search"
                                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-60 bg-white focus:ring-blue-500 focus:border-blue-500 "
                                    placeholder="Search">
                            </div>
                            <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                                <thead
                                    class="text-xs text-gray-950 uppercase bg-gray-50 border-b border-t border-gray-200">
                                    <tr>
                                        {{-- <th class="px-6 py-3.5">No.</th> --}}
                                        <th class="px-6 py-3.5">Name</th>
                                        <th class="px-6 py-3.5">Start Date</th>
                                        <th class="px-6 py-3.5">End Date</th>
                                        <th class="px-6 py-3.5"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaves as $leave)
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                            {{-- <td class="px-6 py-4">{{ $loop->index + 1 }}</td> --}}
                                            <td class="px-6 py-4">{{ $leave->user->name }}</td>
                                            <td class="px-6 py-4">{{ $leave->start_date }}</td>
                                            <td class="px-6 py-4">{{ $leave->end_date }}</td>
                                            <td class="px-6 py-4 flex gap-x-3">
                                                <a href="{{ route('admin.leaves.edit', $leave->id) }}"
                                                    class="font-semibold text-blue-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Admin') }}
                </div>
                <a href="{{ route('admin.users.create') }}">Create</a>
                <a href="{{ route('admin.users.index') }}">Index</a>

            </div> --}}
        </div>
    </div>
</x-app-layout>
