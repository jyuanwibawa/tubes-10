@extends('dashboard.main')

@section('content')
    <div class="px-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="font-poppins font-medium text-gray-800 text-[28px]">Pickup Request Details</h1>
            <a href="{{ route('admin.pickup-requests') }}" class="text-primary-green hover:underline">
                Back to List
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold mb-4">Request Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">User</label>
                            <p class="mt-1">{{ $pickupRequest->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <p class="mt-1">{{ $pickupRequest->address }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <p class="mt-1">{{ $pickupRequest->description }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pickup Time</label>
                            <p class="mt-1">{{ $pickupRequest->pickup_time ? $pickupRequest->pickup_time->format('d M Y H:i') : 'Not specified' }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-4">Status Information</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Current Status</label>
                            <p class="mt-1">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($pickupRequest->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($pickupRequest->status == 'accepted') bg-blue-100 text-blue-800
                                    @elseif($pickupRequest->status == 'rejected') bg-red-100 text-red-800
                                    @else bg-green-100 text-green-800 @endif">
                                    {{ ucfirst($pickupRequest->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Created At</label>
                            <p class="mt-1">{{ $pickupRequest->created_at->format('d M Y H:i') }}</p>
                        </div>
                        @if($pickupRequest->admin_notes)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Admin Notes</label>
                            <p class="mt-1">{{ $pickupRequest->admin_notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-semibold mb-4">Update Status</h2>
                <form action="{{ route('admin.pickup-requests.update', $pickupRequest) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-green focus:ring focus:ring-primary-green focus:ring-opacity-50">
                                <option value="pending" {{ $pickupRequest->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $pickupRequest->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $pickupRequest->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                <option value="completed" {{ $pickupRequest->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                        <div>
                            <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                            <textarea name="admin_notes" id="admin_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-green focus:ring focus:ring-primary-green focus:ring-opacity-50">{{ old('admin_notes', $pickupRequest->admin_notes) }}</textarea>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button type="submit" class="bg-primary-green text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-primary-green focus:ring-opacity-50">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 