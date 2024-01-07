<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-y-6">
            <div class="flex justify-between items-center pt-10">
                <div class=" text-gray-900 font-bold text-2xl">
                    {{ __('Payrolls List') }}
                </div>
                <button class="px-4 py-2 rounded-lg font-bold bg-green-600 text-white"><a
                        href="{{ route('admin.payrolls.create') }}">New Payroll</a> </button>
            </div>
            <div class="relative overflow-x-auto rounded-lg bg-white">
                <form action="{{ route('admin.payrolls.index') }}" method="GET">
                    <label for="table-search" class="sr-only">Search</label>
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
                            <th class="px-6 py-3.5">Salary</th>
                            <th class="px-6 py-3.5">Pay Date</th>
                            <th class="px-6 py-3.5">Status</th>
                            <th class="px-6 py-3.5"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payrolls as $payroll)
                            <tr class="bg-white border-b border-gray-200 hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $loop->index + 1 }}</td>
                                <td class="px-6 py-4">
                                    @if ($payroll->user)
                                        {{ $payroll->user->name }}
                                    @else
                                        No Employee
                                    @endif
                                </td>
                                <td class="px-6 py-4">RM {{ $payroll->salary }}</td>
                                <td class="px-6 py-4">{{ $payroll->pay_date }}</td>
                                <td class="px-6 py-4">
                                    @if ($payroll->status === 'released')
                                        <span
                                            class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded border border-green-400">Released</span>
                                    @else
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded border border-yellow-400">Pending</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 flex gap-x-3 items-center">
                                    <a href="{{ route('admin.payrolls.show', $payroll->id) }}"
                                        class="font-semibold text-blue-600 hover:underline inline-flex items-center justify-center outline-none gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        </svg>
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="py-4 px-6">
                    {{ $payrolls->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
