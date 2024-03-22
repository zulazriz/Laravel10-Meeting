<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MeetingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class MeetingRequestController extends Controller
{
    // Method to generate token for a user
    public function generateToken($userId)
    {
        // Find the user by ID
        $user = User::findOrFail($userId);

        // Generate a new token for the user
        $token = $user->createToken('Token Name')->plainTextToken;

        // Log the token value
        Log::info('Generated token for user ' . $user->id . ': ' . $token);

        // Return the token along with other information in the response
        return response()->json([
            'user' => $user,
            'token' => $token,
            'message' => 'Token generated successfully'
        ]);
    }

    // Method to display the meeting request creation form
    public function create()
    {
        return view('meeting-request.create');
    }

    // Method to store a new meeting request
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string',
            'place' => 'required|string',
            'start_date' => [
                'required',
                'date',
                Rule::unique('meeting_requests')->where(function ($query) use ($request) {
                    return $query->where('start_date', $request->start_date)
                        ->where('start_time', $request->start_time);
                }),
            ],
            'start_time' => 'required|date_format:H:i',
        ]);

        // Attempt to create the meeting request
        $meetingRequest = MeetingRequest::create($request->all());

        // Flash a success or error message based on the outcome
        if ($meetingRequest !== null) {
            Session::flash('success', 'Meeting request registered successfully!');
        } else {
            Session::flash('error', 'Failed to register meeting request.');
        }

        // Redirect to the dashboard page
        return redirect()->route('dashboard');
    }

    // Method to display the meeting request edit form
    public function edit($id)
    {
        // Find the meeting request by ID and pass it to the edit view
        $meetingRequest = MeetingRequest::findOrFail($id);
        return view('meeting_request.edit', compact('meetingRequest'));
    }

    // Method to display the dashboard with all meeting requests
    public function index()
    {
        // Retrieve all meeting requests and pass them to the dashboard view
        $meetingRequests = MeetingRequest::all();
        return view('dashboard', ['meetingRequests' => $meetingRequests]);
    }

    // Method to delete a meeting request
    public function destroy(MeetingRequest $meetingRequest)
    {
        // Delete the specified meeting request
        $meetingRequest->delete();
        
        // Redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Meeting request deleted successfully!');
    }
}
