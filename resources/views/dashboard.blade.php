<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- //content --}}
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
                        <a href="{{ route('absents.index') }}" >
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
    
    
</x-app-layout>