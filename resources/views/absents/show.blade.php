<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Show Student') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto">
                    <!-- Judul Halaman -->
                    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Student Absent</h1>
                
                    <!-- Card untuk Detail Absent -->
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <div class="bg-blue-600 text-white text-lg font-semibold px-6 py-4">
                            Absence Details
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-5">
                                <!-- Nama Student -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Student Name</h2>
                                    <p class="text-gray-800">{{ $absent->student_name ?? 'N/A' }}</p>
                                </div>
                            
                                <!-- Nama Subject -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Subject Name</h2>
                                    <p class="text-gray-800">{{ $absent->subject_name ?? 'N/A' }}</p>
                                </div>
                            
                                <!-- Status -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Status</h2>
                                    <span class="inline-block px-3 py-1 text-sm font-medium rounded-lg 
                                        {{ $absent->status === 'Present' ? 'bg-green-500 text-white' : ($absent->status === 'Alpha' ? 'bg-red-500 text-white' : 'bg-yellow-500 text-gray-800') }}">
                                        {{ ucfirst($absent->status) }}
                                    </span>
                                </div>
                            </div>                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Start Date & Time -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Start Date & Time</h2>
                                    <p class="text-gray-800">{{ $absent->subject_start_datetime ?? 'N/A' }}</p>
                                </div>
                
                                <!-- End Date & Time -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">End Date & Time</h2>
                                    <p class="text-gray-800">{{ $absent->subject_end_datetime ?? 'N/A' }}</p>
                                </div>
                
                                <!-- Start Location -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Start Location</h2>
                                    <p class="text-gray-800">{{ $absent->location_start ?? 'N/A' }}</p>
                                </div>
                
                                <!-- End Location -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">End Location</h2>
                                    <p class="text-gray-800">{{ $absent->location_end ?? 'N/A' }}</p>
                                </div>
                
                                <!-- Daily Report -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Daily Report</h2>
                                    <p class="text-gray-800">{{ $absent->daily_report ?? 'N/A' }}</p>
                                </div>
                
                                <!-- Daily Note -->
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Daily Note</h2>
                                    <p class="text-gray-800">{{ $absent->daily_note ?? 'N/A' }}</p>
                                </div>
                            </div>
                
                            <!-- Proof Photos -->
                            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Proof Photo (Start)</h2>
                                    @if ($absent->proof_photo_start)
                                        <div class="w-[280px] h-[280px] border-black border rounded-md ">
                                            <img src="{{ asset('storage/' . $absent->proof_photo_start) }}" alt="Start Proof" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <p class="text-gray-800"><em>No photo available</em></p>
                                    @endif
                                </div>
                
                                <div>
                                    <h2 class="text-sm font-semibold text-gray-600">Proof Photo (End)</h2>
                                    @if ($absent->proof_photo_end)
                                        <div class="w-[280px] h-[280px] border-black border rounded-md ">
                                            <img src="{{ asset('storage/' . $absent->proof_photo_end) }}" alt="End Proof" class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <p class="text-gray-800"><em>No photo available</em></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                
                        <!-- Footer -->
                        <div class="flex space-x-4 ms-6 mb-5">
                            @if (auth()->user()->hasRole('Pegawai Tetap') || auth()->user()->hasRole('Admin') || auth()->user()->hasRole('Developer'))    
                            <a class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg shadow"
                                href="{{ route('absents.edit',$absent->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </a>
                            <form action="{{ route('absents.destroy', $absent->id) }}" method="POST" onsubmit="return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg shadow">Delete</button>
                            </form>
                            @endif
                            @php
                                $userRole = Auth::user()->roles->pluck('name')->first(); // Ambil nama peran pertama
                                $backRoute = in_array($userRole, ['Magang', 'Paruh Waktu']) 
                                            ? route('dashboard') 
                                            : route('absents.index');
                            @endphp
                            <a href="{{ $backRoute }}" class="inline-flex items-center px-3 py-2 my-0.5 text-sm font-medium text-gray-700 bg-gray-300 hover:bg-gray-400 rounded-lg shadow">
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmDelete(){
            return confirm("Are you sure you want to delete this absent?")
        }
    </script>
</x-app-layout>