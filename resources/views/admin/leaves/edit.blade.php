<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 flex flex-col gap-y-6">
            <div>
                <div class="text-gray-900 text-2xl font-bold pt-10">
                    {{ __('Edit Leave') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.leaves.update', $leave->id) }}" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="pb-4">
                        <label class="block mb-2 text-sm font-medium">Employee Name</label>
                        <input type="text" value="{{ $leave->user->name }}" disabled
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    </div>

                    <!-- Keep the hidden user_id input -->
                    <input type="hidden" name="user_id" value="{{ $leave->user_id }}">
                    <div class="grid grid-cols-2 gap-x-8">
                        <div class="">
                            <div class="pb-4">
                                <label for="start_date" class="block mb-2 text-sm font-medium">Start Date</label>
                                <input type="date" id="start_date" name="start_date" value="{{ $leave->start_date }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" required />
                            </div>

                            <div class="pb-4">
                                <label for="end_date" class="block mb-2 text-sm font-medium">End Date</label>
                                <input type="date" id="end_date" name="end_date" value="{{ $leave->end_date }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" required />
                            </div>
                        </div>

                        <div class="">
                            <div class="pb-4">
                                <label for="leave_type" class="block mb-2 text-sm font-medium">Leave Type</label>
                                <select id="leave_type" name="leave_type"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="annual" {{ $leave->leave_type === 'annual' ? 'selected' : '' }}>
                                        Annual Leave</option>
                                    <option value="sick" {{ $leave->leave_type === 'sick' ? 'selected' : '' }}>
                                        Sick
                                        Leave</option>
                                </select>
                            </div>

                            <div class="pb-4">
                                <label for="description" class="block mb-2 text-sm font-medium">Description</label>
                                <textarea id="description" name="description"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Enter leave description" required>{{ $leave->description }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-x-2">
                        @if ($leave->status != 'approved')
                            <button type="submit" name="status" value="approved"
                                class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">
                                Approve
                            </button>
                        @endif

                        @if ($leave->status != 'approved' && $leave->status != 'rejected')
                            <button type="button" onclick="openRejectModal()"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-centerg-blue-800">
                                Reject
                            </button>
                        @endif

                        <button type="button" data-modal-target="add-user-modal" data-modal-toggle="add-user-modal"
                            class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Add user
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
