@extends('dashboard.main')

@section('content')
<p class="font-poppins font-medium text-gray-800 text-[28px] ms-10 mb-6">Pickup Requests</p>

<div class="px-10 w-full">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-white uppercase bg-primary-green">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Pickup Time
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created At
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pickupRequests as $request)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <td class="px-6 py-4">
                        {{ $request->user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Str::limit($request->address, 30) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ Str::limit($request->description, 30) }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $request->pickup_time ? $request->pickup_time->format('d M Y H:i') : 'Not specified' }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                @if($request->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($request->status == 'accepted') bg-blue-100 text-blue-800
                                @elseif($request->status == 'rejected') bg-red-100 text-red-800
                                @else bg-green-100 text-green-800 @endif">
                            {{ ucfirst($request->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        {{ $request->created_at->format('d M Y H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.pickup-requests.show', $request) }}"
                            class="text-primary-green hover:underline">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr class="bg-white border-b">
                    <td colspan="7" class="px-6 py-4 text-center">
                        No pickup requests found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="px-10 mt-4">
    {{ $pickupRequests->links() }}
</div>
@endsection