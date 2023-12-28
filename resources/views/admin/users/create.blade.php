<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Admin Create User') }}
                </div>
                <form method="POST" action="{{ route('admin.users.store') }}" class="px-6 pb-6">
                    @csrf
                    <div class="grid grid-cols-2 gap-x-8">
                        <div class="">
                            <div class="pb-4">
                                <label for="first_name" class="block mb-2 text-sm font-medium">Name</label>
                                <input type="text" id="first_name" name="name"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" required />
                            </div>

                            <div class="pb-4">
                                <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                                <input type="email" id="first_name" name="email"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" required />
                            </div>

                            <div class="pb-4">
                                <label for="employment_type" class="block mb-2 text-sm font-medium">Employment
                                    Type</label>
                                <select id="employment_type" name="type"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="full_time">Full-Time</option>
                                    <option value="part_time">Part-Time</option>
                                </select>
                            </div>

                        </div>

                        <div class="">
                            <div class="pb-4">
                                <label for="username" class="block mb-2 text-sm font-medium">Phone No.</label>
                                <input type="tel" id="first_name" name="phone_number"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" required />
                            </div>

                            <div class="pb-4">
                                <label for="email" class="block mb-2 text-sm font-medium">Hire Date</label>
                                <input type="text" name="hire_date"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date">
                            </div>

                            <div class="pb-4">
                                <label for="role" class="block mb-2 text-sm font-medium">Role</label>
                                <select id="role" name="role"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="2">Employee</option>
                                    <option value="1">Admin</option>
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
