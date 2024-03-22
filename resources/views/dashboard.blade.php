<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        Booked meeting room
                    </h2>
                    <div class="table-responsive">
                        <!-- Table to display meeting requests -->
                        <table id="example" class="table" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- Table header columns -->
                                    <th>Name</th>
                                    <th>Place</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through each meeting request -->
                                @foreach($meetingRequests as $meetingRequest)
                                <tr>
                                    <!-- Display meeting request details -->
                                    <td class="text-center">{{ $meetingRequest->name }}</td>
                                    <td class="text-center">{{ $meetingRequest->place }}</td>
                                    <td class="text-center">{{ $meetingRequest->start_date }}</td>
                                    <td class="text-center">{{ $meetingRequest->start_time }}</td>
                                    <td class="text-center">
                                        <!-- Form to submit delete request -->
                                        <form action="{{ route('meeting-request.destroy', $meetingRequest->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn" data-id="{{ $meetingRequest->id }}">
                                                <i class="fas fa-trash" style="color: red;"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Snackbar for success and error messages -->
    @if(session('success'))
    <div id="snackbar" class="bg-green-500 text-white text-center py-3 px-4 rounded-md shadow-md">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div id="snackbar" class="bg-red-500 text-white text-center py-3 px-4 rounded-md shadow-md">
        {{ session('error') }}
    </div>
    @endif

    @push('scripts')

    <!-- Include Toastr (like snackbar) library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#example').DataTable();
        });

        // Show Toastr notifications for success and error messages
        $(document).ready(function() {
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}", '', {"timeOut": 2000, "toastClass": "toast-small"});
            @elseif(Session::has('error'))
                toastr.error("{{ Session::get('error') }}", '', {"timeOut": 2000, "toastClass": "toast-small"});
            @endif
        });
    </script>
    @endpush
</x-app-layout>
