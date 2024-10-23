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
                    <div class="absolute inset-0 my-[20px] ">
                        <div class="flex justify-center gap-6 items-center h-full">
                            <div class="flex justify-center items-center"> 
                                <img src="{{ asset('images/user.png') }}" alt="Logo" class="h-[80px] w-[80px]">
                            </div>
                            <div class="flex flex-col justify-center items-center text-center w-[60%]">
                                <div class="my-[10px] text-lg">
                                    Total Users
                                </div>
                                <div class="w-[90%] bg-gray-200 rounded-md">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-md" style="width: 5%;">
                                        <span class="text-xs font-medium text-white">5%</span>
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                        <a href="http://localhost/simasi-app/users" >
                            <div class="absolute text-sm right-[15px] bottom-[-15px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
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
                                <div class="w-[90%] bg-gray-200 rounded-md">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-md" style="width: 75%;">
                                        <span class="text-xs font-medium text-white">75%</span>
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                        <a href="http://localhost/simasi-app/Absents" >
                            <div class="absolute text-sm right-[15px] bottom-[-15px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
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
                                <img src="{{ asset('images/student.png') }}" alt="Logo" class="h-[80px] w-[80px]">
                            </div>
                            <div class="flex flex-col justify-center items-center text-center w-[60%]">
                                <div class="my-[10px] text-lg">
                                    Total Students
                                </div>
                                <div class="w-[90%] bg-gray-200 rounded-md">
                                    <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-md" style="width: 75%;">
                                        <span class="text-xs font-medium text-white">75%</span>
                                    </div>
                                </div>                                
                            </div>
                            
                        </div>
                        <a href="http://localhost/simasi-app/students" >
                            <div class="absolute text-sm right-[15px] bottom-[-15px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
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
                            <div class="w-[90%] bg-gray-200 rounded-md">
                                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-md" style="width: 75%;">
                                    <span class="text-xs font-medium text-white">75%</span>
                                </div>
                            </div>                                
                        </div>
                        
                    </div>
                    <a href="http://localhost/simasi-app/subjects" >
                        <div class="absolute text-sm right-[15px] bottom-[-15px] flex justify-end py-[2px] px-[10px] bg-blue-800 text-white rounded-md transition-transform duration-200 ease-in-out hover:bg-blue-700">
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
