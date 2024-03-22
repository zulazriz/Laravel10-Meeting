<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex justify-center"> 
                    <div class="max-w-md w-full"> <!-- Added w-full class here -->
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                            {{ __('Register Meeting Request') }}
                        </h2>
                        <!-- Meeting request form -->
                        <form method="POST" action="{{ route('meeting-request.store') }}">
                            @csrf

                            <!-- Name input field -->
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm border-gray-300" required>
                            </div>

                            <!-- Place input field -->
                            <div class="mb-4">
                                <label for="place" class="block text-gray-700 text-sm font-bold mb-2">Place:</label>
                                <input type="text" name="place" id="place" class="form-input rounded-md shadow-sm border-gray-300" required>
                            </div>

                            <!-- Date input field -->
                            <div class="mb-4">
                                <label for="start_date" class="block text-gray-700 text-sm font-bold mb-2">Date:</label>
                                <input type="date" name="start_date" id="start_date" class="form-input rounded-md shadow-sm border-gray-300" required>
                            </div>

                            <!-- Start time input field -->
                            <div class="mb-4">
                                <label for="start_time" class="block text-gray-700 text-sm font-bold mb-2">Start Time:</label>
                                <input type="time" name="start_time" id="start_time" class="form-input rounded-md shadow-sm border-gray-300" required>
                            </div>

                            <!-- Submit button -->
                            <div class="mt-6">
                                <button type="submit" style="background-color: #008000; color: white; font-weight: bold; padding: 10px 20px; border: none; border-radius: 5px;">
                                    Request Meeting
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
