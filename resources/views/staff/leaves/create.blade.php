<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 flex flex-col gap-y-6">
            <div>
                <div class="text-gray-900 text-2xl font-bold pt-10">
                    {{ __('New Leave Request') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('staff.leaves.store') }}" class="p-6">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                    <div class="grid grid-cols-2 gap-x-8">
                        <div class="">
                            <div class="pb-4">
                                <label for="start_date" class="block mb-2 text-sm font-medium">Start Date</label>
                                <input type="date" id="start_date" name="start_date"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" required />
                            </div>
                            <div class="pb-4">
                                <label for="leave_type" class="block mb-2 text-sm font-medium">Leave Type</label>
                                <select id="leave_type" name="leave_type"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="annual">Annual Leave</option>
                                    <option value="sick">Sick Leave</option>
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <div class="pb-4">
                                <label for="end_date" class="block mb-2 text-sm font-medium">End Date</label>
                                <input type="date" id="end_date" name="end_date"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" required />
                            </div>
                            <div class="pb-4">
                                <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                                <textarea id="description" name="description"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter leave description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
