<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-6">
            <div class="flex justify-between">
                <div class=" text-gray-900 text-3xl font-bold">
                    {{ __('Employees List') }}
                </div>
                <button class="px-4 py-2 rounded-lg font-bold bg-green-600 text-white"><a
                        href="{{ route('admin.employees.create') }}">New Employee</a> </button>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-950">
                    <thead class="text-xs text-gray-950 uppercase bg-gray-200">
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
                                <td class="px-6 py-4">{{ $leave->leave_type }}</td>
                                <td class="px-6 py-4">{{ $leave->status }}</td>

                                <td class="px-6 py-4 flex gap-x-3">
                                    {{-- <a href="{{ route('admin.leave.edit', $leave->id) }}"
                                        class="text-blue-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <!-- Edit Icon SVG Path -->
                                        </svg>
                                        Edit
                                    </a> --}}
                                    {{-- <form action="{{ route('admin.leave.destroy', $leave->id) }}" method="POST"
                                        class="text-red-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <!-- Delete Icon SVG Path -->
                                            </svg>
                                            Delete
                                        </button>
                                    </form> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
