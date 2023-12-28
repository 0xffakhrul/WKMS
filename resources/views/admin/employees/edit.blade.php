<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="pb-6 text-gray-900 font-bold text-3xl">
                {{ __('Edit ' . $employee->name) }}
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ url('/admin/employees/' . $employee->id) }}" class="p-6"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-x-8">
                        <div class="">
                            <div class="pb-4">
                                <label for="first_name" class="block mb-2 text-sm font-medium">Name</label>
                                <input type="text" id="first_name" name="name"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" value="{{ $employee->name }}" required />
                            </div>

                            <div class="pb-4">
                                <label for="email" class="block mb-2 text-sm font-medium">Email</label>
                                <input type="email" id="first_name" name="email"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" value="{{ $employee->email }}" required />
                            </div>

                            <div class="pb-4">
                                <label for="employment_type" class="block mb-2 text-sm font-medium">Employment
                                    Type</label>
                                <select id="employment_type" name="type"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="full_time" {{ $employee->type == 'full_time' ? 'selected' : '' }}>
                                        Full-Time</option>
                                    <option value="part_time" {{ $employee->type == 'part_time' ? 'selected' : '' }}>
                                        Part-Time</option>
                                </select>
                            </div>

                        </div>

                        <div class="">
                            <div class="pb-4">
                                <label for="username" class="block mb-2 text-sm font-medium">Phone No.</label>
                                <input type="tel" id="first_name" name="phone_number"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="John" value="{{ $employee->phone_number }}" required />
                            </div>

                            <div class="pb-4">
                                <label for="email" class="block mb-2 text-sm font-medium">Hire Date</label>
                                <input type="text" name="hire_date"
                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Select date" value="{{ $employee->hire_date }}">
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
