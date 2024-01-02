<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-8 flex flex-col gap-y-6">
            <div>
                <div class="text-gray-900 text-2xl font-bold pt-10">
                    {{ __('New Employee') }}
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.users.store') }}" class="p-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-x-8">
                        <div>
                            <div class="pb-4">
                                <label for="name" class="block mb-2 text-sm font-medium">Name</label>
                                <input type="text" id="name" name="name"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" value="{{ old('name') }}" required />
                            </div>

                            <div class="pb-4">
                                <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                                <input type="email" id="email" name="email"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="john@example.com" value="{{ old('email') }}" required />
                            </div>

                            <div class="pb-4">
                                <label for="employment_type" class="block mb-2 text-sm font-medium">Employment
                                    Type</label>
                                <select id="employment_type" name="type"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="full_time" {{ old('type') == 'full_time' ? 'selected' : '' }}>
                                        Full-Time</option>
                                    <option value="part_time" {{ old('type') == 'part_time' ? 'selected' : '' }}>
                                        Part-Time</option>
                                </select>
                            </div>

                        </div>

                        <div>
                            <div class="pb-4">
                                <label for="phone_number" class="block mb-2 text-sm font-medium">Phone No.</label>
                                <input type="tel" id="phone_number" name="phone_number"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="123-456-7890" value="{{ old('phone_number') }}" required />

                                @error('phone_number')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="pb-4">
                                <label for="hire_date" class="block mb-2 text-sm font-medium">Hire Date</label>
                                <input type="date" id="hire_date" name="hire_date" value="{{ old('hire_date') }}"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" required>
                            </div>

                            <div class="pb-4">
                                <label for="role" class="block mb-2 text-sm font-medium">Role</label>
                                <select id="role" name="role"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>Employee</option>
                                    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Admin</option>
                                </select>
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
