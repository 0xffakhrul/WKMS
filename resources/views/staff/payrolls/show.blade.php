<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 flex flex-col gap-y-6">
            <div>
                <div class="text-gray-900 text-2xl font-bold pt-10">
                    {{ __('View payroll') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-x-8">
                        <div class="">
                            <div class="pb-4">
                                <label class="block mb-2 text-sm font-medium">Employee Name</label>
                                <input type="text" value="{{ $payroll->user->name }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    disabled />
                            </div>
                            <div class="pb-4">
                                <label for="start_date" class="block mb-2 text-sm font-medium">Pay Date</label>
                                <input type="text" id="start_date" name="start_date" value="{{ $payroll->pay_date }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" disabled />
                            </div>
                            <div class="pb-4">
                                <label class="block mb-2 text-sm font-medium">Working Hours</label>
                                @if ($payroll->user->type === 'part_time')
                                    <input type="text" value="{{ $workingHours }} Hours"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        disabled />
                                @else
                                    <span class="text-gray-500">N/A</span>
                                @endif
                            </div>
                        </div>
                        <div class="">
                            <div class="pb-4">
                                <label for="start_date" class="block mb-2 text-sm font-medium">Salary</label>
                                <input type="salary" id="salary" name="salary" value="RM {{ $payroll->salary }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" disabled />
                            </div>
                            <div class="pb-4">
                                <label class="block mb-2 text-sm font-medium">User Type</label>
                                <input type="text"
                                    value="{{ $payroll->user->type === 'part_time' ? 'Part Time' : 'Full Time' }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    disabled />
                            </div>
                            <div class="pb-4">
                                <label for="payroll_type" class="block mb-2 text-sm font-medium">Status</label>
                                <select id="payroll_type" name="payroll_type"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    disabled>
                                    <option value="released" {{ $payroll->status === 'released' ? 'selected' : '' }}>
                                        Released</option>
                                    <option value="pending" {{ $payroll->status === 'pending' ? 'selected' : '' }}>
                                        Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <p class="p-6 font-bold text-2xl">Net Salary: RM {{ $payroll->salary }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
