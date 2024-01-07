<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 flex flex-col gap-y-6">
            <div>
                <div class="text-gray-900 text-2xl font-bold pt-10">
                    {{ __('Leave Request Details') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Display Leave Request Details -->
                    <div class="grid grid-cols-2 gap-x-8">
                        <div>
                            <div class="pb-4">
                                <label for="start_date" class="block mb-2 text-sm font-medium">Start Date</label>
                                <input type="text" id="start_date" name="start_date" value="{{ $leave->start_date }}"
                                    disabled
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div class="pb-4">
                                <label for="leave_type" class="block mb-2 text-sm font-medium">Leave Type</label>
                                <select id="leave_type" name="leave_type" disabled
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="annual" {{ $leave->leave_type === 'annual' ? 'selected' : '' }}>
                                        Annual
                                        Leave</option>
                                    <option value="sick" {{ $leave->leave_type === 'sick' ? 'selected' : '' }}>Sick
                                        Leave</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <div class="pb-4">
                                <label for="end_date" class="block mb-2 text-sm font-medium">End Date</label>
                                <input type="text" id="end_date" name="end_date" value="{{ $leave->end_date }}"
                                    disabled
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                            </div>
                            <div class="pb-4">
                                <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                                <textarea id="description" name="description" disabled
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $leave->description }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
