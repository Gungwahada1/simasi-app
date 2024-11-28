<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- session for absent --}}
    @if ($message = Session::get('success'))
    <div id="alert-success" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-green-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0 5 5 0 01-10 0z"></path>
            </svg>
            <span class="font-medium">{{ $message }}</span>
        </div>
    </div>
    @endif

    @if ($message = Session::get('warning'))
        <div id="alert-warning" class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 12a5 5 0 1110 0 5 5 0 01-10 0z"></path>
                </svg>
                <span class="font-medium">{{ $message }}</span>
            </div>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div id="alert-info" class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded-lg shadow-lg mb-4 animate-bounce-in-down" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm.75 5.75h-1.5v1.5h1.5zm0 4h-1.5v6h1.5z"></path>
                </svg>                                                      
                <span class="font-medium">{{ $message }}</span>
            </div>
        </div>
    @endif
    {{-- dashboard cards information --}}
    <div class="w-full h-full"> 
        <div class="w-full py-8">         
            <div class="w-full h-full flex justify-center items-center gap-4"> 
                {{-- user card start --}}
                <div class="relative w-[20%] h-[160px] bg-white rounded-md shadow-xl border-2 transition-transform duration-200 ease-in-out hover:scale-95">
                    <div class="absolute inset-0 my-[20px]">
                        <div class="flex justify-center gap-6 items-center h-full">
                            <div class="flex justify-center items-center"> 
                                <img src="{{ asset('images/user.png') }}" alt="Logo" class="h-[80px] w-[80px]">
                            </div>
                            <div class="flex flex-col justify-center items-center text-center w-[60%]">
                                <div class="my-[10px] text-lg">
                                    Total Users
                                </div>
                                <div class="text-center rounded-md">
                                    <div class="text-[20px]">
                                        {{ $totalUsers }}
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <a href="{{ route('users.index') }}">
                            <div class="absolute text-sm right-[15px] bottom-[-10px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
                                {{ __('Go to Data') }}
                            </div>  
                        </a>
                    </div>
                </div>
                {{-- user card end --}}
                {{-- user card start --}}
                <div class="relative w-[20%] h-[160px] bg-white rounded-md shadow-xl border-2 transition-transform duration-200 ease-in-out hover:scale-95">
                    <div class="absolute inset-0 my-[20px] ">
                        <div class="flex justify-center gap-6 items-center h-full">
                            <div class="flex justify-center items-center"> 
                                <img src="{{ asset('images/absent.png') }}" alt="Logo" class="h-[80px] w-[80px]">
                            </div>
                            <div class="flex flex-col justify-center items-center text-center w-[60%]">
                                <div class="my-[10px] text-lg">
                                    Total Absents
                                </div>
                                <div class="text-center rounded-md">
                                    <div class="text-[20px]">
                                        {{ $totalAbsents }}
                                    </div>
                                </div>                                  
                            </div>  
                        </div>
                        @php
                            $userRole = Auth::user()->roles->pluck('name')->first(); // Ambil nama peran pertama
                            $showOrIndexRoute = in_array($userRole, ['Magang', 'Paruh Waktu']) 
                                        ? route('absents.show', Auth::user()->id) 
                                        : route('absents.index');
                        @endphp
                        <a href="{{ $showOrIndexRoute }}" >
                            <div class="absolute text-sm right-[15px] bottom-[-10px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
                                {{ __('Go to Data') }}
                            </div>  
                        </a>
                        
                    </div>
                </div>
                {{-- user card end --}}
                {{-- user card start --}}
                <div class="relative w-[20%] h-[160px] bg-white rounded-md shadow-xl border-2 transition-transform duration-200 ease-in-out hover:scale-95">
                    <div class="absolute inset-0 my-[20px] ">
                        <div class="flex justify-center items-center h-full">
                            <div class="flex justify-center items-center"> 
                                <img src="{{ asset('images/student.png') }}" alt="Logo" class="h-[80px] w-[80px]">
                            </div>
                            <div class="flex flex-col justify-center items-center text-center w-[60%]">
                                <div class="my-[10px] text-lg">
                                    Total Students
                                </div>
                                <div class="text-center rounded-md">
                                    <div class="text-[20px]">
                                        {{ $totalStudents }}
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                        <a href="{{ route('students.index') }}" >
                            <div class="absolute text-sm right-[15px] bottom-[-10px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
                                {{ __('Go to Data') }}
                            </div>  
                        </a>
                        
                    </div>
                </div>
                {{-- user card end --}}
               {{-- user card start --}}
               <div class="relative w-[20%] h-[160px] bg-white rounded-md shadow-xl border-2 transition-transform duration-200 ease-in-out hover:scale-95">
                <div class="absolute inset-0 my-[20px] ">
                    <div class="flex justify-center gap-6 items-center h-full">
                        <div class="flex justify-center items-center"> 
                            <img src="{{ asset('images/subject.png') }}" alt="Logo" class="h-[80px] w-[80px]">
                        </div>
                        <div class="flex flex-col justify-center items-center text-center w-[60%]">
                            <div class="my-[10px] text-lg">
                                Total Subjects
                            </div>
                            <div class="text-center rounded-md">
                                <div class="text-[20px]">
                                    {{ $totalSubjects }}
                                </div>
                            </div>                                 
                        </div>
                        
                    </div>
                    <a href="{{ route('subjects.index') }}" >
                        <div class="absolute text-sm right-[15px] bottom-[-10px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
                            {{ __('Go to Data') }}
                        </div>  
                    </a>
                    
                </div>
            </div>
            {{-- user card end --}}
            </div>
        </div>
    </div>
    {{-- tampilan absent singkat --}}
    <div class="my-6 mx-auto md:max-w-[1120px]">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Absent List</h1>
        @if ($absent)
            <div class="bg-white rounded-md shadow-xl border-2 overflow-hidden">
                <div class="p-4">
                    <!-- Nama Student -->
                    <h2 class="text-2xl font-semibold text-gray-800 mb-3">{{ $absent->student_name ?? 'N/A' }}</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Nama Subject -->
                        <p class="text-base text-gray-600"><b>Subject:</b> {{ $absent->subject_name ?? 'N/A' }}</p>
                        
                        <!-- Status -->
                        <p class="text-base text-gray-600"><b>Status:</b> 
                            <span class="inline-block px-2 py-1 text-sm font-medium rounded-lg 
                                {{ $absent->status === 'Present' ? 'bg-green-500 text-white' : ($absent->status === 'Alpha' ? 'bg-red-500 text-white' : 'bg-yellow-500 text-gray-800') }}">
                                {{ ucfirst($absent->status) }}
                            </span>
                        </p>
                        
                        <!-- Start & End Date -->
                        <p class="text-base text-gray-600"><b>Start:</b> {{ $absent->subject_start_datetime ?? 'N/A' }}</p>
                        <p class="text-base text-gray-600"><b>End:</b> {{ $absent->subject_end_datetime ?? 'N/A' }}</p>
                    </div>
                    
                    <!-- Tautan ke Halaman Show -->
                    <a href="{{ route('absents.show', $absent->id) }}" 
                       class="block mt-4 text-base text-blue-600 hover:underline">
                        View Details
                    </a>
                </div>
            </div>
        @else
            <p class="text-gray-600">No absent found for you.</p>
        @endif
    </div>    
    <script>
        setTimeout(function() {
        let alertTypes = ['alert-success', 'alert-warning', 'alert-danger', 'alert-info'];

        alertTypes.forEach(function(id) {
            let alertElement = document.getElementById(id);
            if (alertElement) {
                alertElement.style.transition = 'opacity 0.5s ease';
                alertElement.style.opacity = '0';
                setTimeout(function() { alertElement.remove(); }, 500);
            }
        });
        }, 5000);
    </script>
</x-app-layout>