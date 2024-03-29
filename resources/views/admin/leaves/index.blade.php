<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-6">
            <div class="flex justify-between items-center pt-10">
                <div class=" text-gray-900 font-bold text-2xl">
                    {{ __('Leave Requests List') }}
                </div>
                <button class="px-4 py-2 rounded-lg font-bold bg-green-600 text-white"><a
                        href="{{ route('admin.leaves.create') }}">New Leave Requests</a> </button>
            </div>
            <div class="relative overflow-x-auto rounded-lg bg-white">
                <form action="{{ route('admin.leaves.index') }}" method="GET">

                    <div class="flex items-center">
                        <div class="relative m-4">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-950" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="table-search"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-60 bg-white focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Search" value="{{ $search }}">
                        </div>
                        <div>
                            <button type="submit"
                                class="px-4 py-2 rounded-lg text-sm font-semibold bg-blue-600 text-white">Search</button>
                        </div>
                    </div>
                </form>
                <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                    <thead class="text-xs text-gray-950 uppercase bg-gray-50 border-b border-t border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">No.</th>
                            <th class="px-6 py-3.5">Employee</th>
                            <th class="px-6 py-3.5">Start Date</th>
                            <th class="px-6 py-3.5">End Date</th>
                            <th class="px-6 py-3.5">Leave Type</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4">
                                    @if ($leave->user)
                                        {{ $leave->user->name }}
                                    @else
                                        No Employee
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $leave->start_date }}</td>
                                <td class="px-6 py-4">{{ $leave->end_date }}</td>
                                <td class="px-6 py-4">
                                    @if ($leave->leave_type === 'annual')
                                        Annual
                                    @else
                                        Sick
                                    @endif
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

                                <td class="px-6 py-4 flex gap-x-3 items-center">
                                    <a href="{{ route('admin.leaves.edit', $leave->id) }}"
                                        class="text-blue-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.leaves.destroy', $leave->id) }}" method="POST"
                                        class="text-red-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:underline inline-flex items-center justify-center outline-none gap-1"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                            Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="py-4 px-6">
                    {{ $leaves->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
