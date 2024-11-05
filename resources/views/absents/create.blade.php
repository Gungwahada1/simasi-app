<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Absent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('students.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!-- User_id -->
                            <div>
                                <label for="user_id" class="block font-medium text-sm text-gray-700">Name</label>
                                <input type="text" name="user_id" id="user_id" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('name') }}">
                                @error('user_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!--Detail subject id -->
                            <div>
                                <label for="detail_subject_id" class="block font-medium text-sm text-gray-700">Detail Subject</label>
                                <input type="text" name="detail_subject_id" id="detail_subject_id" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('detail_subject_id') }}">
                                @error('detail_subject_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                                <select name="status" id="status" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Present" {{ old('status') == 'Present' ? 'selected' : '' }}>Present</option>
                                    <option value="Permission" {{ old('status') == 'Permission' ? 'selected' : '' }}>Permission</option>
                                    <option value="'Sick'" {{ old('status') == 'Sick' ? 'selected' : '' }}>Sick</option>
                                    <option value="'Alpha'" {{ old('status') == 'Alpha' ? 'selected' : '' }}>Alpha</option>
                                </select>
                                @error('status')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex items-center gap-[20px] w-full">
                                <div class="w-full">
                                    <div>
                                        <label for="subject_start_datetime" class="block font-medium text-sm text-gray-700">Start Date Time</label>
                                        <input type="datetime-local" name="subject_start_datetime" id="subject_start_datetime" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('subject_start_datetime') }}">
                                        @error('subject_start_datetime')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="subject_end_datetime" class="block font-medium text-sm text-gray-700">End Date Time</label>
                                        <input type="datetime-local" name="subject_end_datetime" id="subject_end_datetime" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('subject_end_datetime') }}">
                                        @error('subject_end_datetime')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="text-center">
                                        Total Ngajar
                                    </div>
                                    <div class="w-[240px] border-black border rounded-md shadow-sm">
                                        <p id="total-duration" class="text-center px-2 py-2">
                                            0 Days 0 Hours 0 Minutes
                                        </p>
                                    </div>
                                    <div class="flex justify-around">
                                        <button type="button" onclick="btnDuration()" class="mt-2 w-[45%] py-2 bg-blue-500 text-white rounded-md">Hitung</button>
                                        <button type="button" onclick="btnReset()" class="mt-2 w-[45%] py-2 bg-red-500 text-white rounded-md">Reset</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex w-full gap-[20px]">
                                <div class="w-full">
                                    <div>
                                        <label for="proof_photo_start" class="block font-medium text-sm text-gray-700">Photo Start</label>
                                        <input type="file" name="proof_photo_start" id="proof_photo_start" class="form-input rounded-md shadow-sm mt-1 block w-full" onchange="previewImage('proof_photo_start', 'img_start')">
                                        @error('proof_photo_start')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <div class="w-[280px] h-[280px] border-black border rounded-md ">
                                            <img id="img_start" src="" alt="Belum Ada Gambar" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <label for="proof_photo_end" class="block font-medium text-sm text-gray-700">Photo End</label>
                                        <input type="file" name="proof_photo_end" id="proof_photo_end" class="form-input rounded-md shadow-sm mt-1 block w-full" onchange="previewImage('proof_photo_end', 'img_end')">
                                        @error('proof_photo_end')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <div class="w-[280px] h-[280px] border-black border rounded-md">
                                            <img id="img_end" src="" alt="Belum Ada Gambar" class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex gap-[10px]">
                                    <div class="w-full">
                                        <label for="location_start" class="block font-medium text-sm text-gray-700">Location Start</label>
                                        <input type="url" name="location_start" id="location_start" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('location_start') }}">
                                        @error('location_start')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-full">
                                        <label for="location_end" class="block font-medium text-sm text-gray-700">Location End</label>
                                        <input type="url" name="location_end" id="location_end" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('location_end') }}">
                                        @error('location_end')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div id="map" class="border border-black w-full h-[500px] mt-[20px]"></div>
                                <div class="flex gap-[30px] mt-2">
                                    <a href="#" onclick="getLocation()" id="setStartLocation" class="w-full bg-blue-800 text-center py-2 text-white rounded-md">Set Start Location</a>
                                    <button id="setEndLocation" class="w-full bg-blue-800 text-center py-2 text-white rounded-md">Set End Location</button>
                                </div>
                            </div>
                            
                            
                            <div>
                                <label for="daily_report" class="block font-medium text-sm text-gray-700">Daily Report</label>
                                <textarea name="daily_report" id="daily_report" class="form-input resize-none  rounded-md shadow-sm mt-1 block w-full h-[120px]">{{ old('daily_report') }}</textarea>
                                @error('daily_report')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="daily_note" class="block font-medium text-sm text-gray-700">Daily Note</label>
                                <textarea name="daily_note" id="daily_note" class="form-input resize-none  rounded-md shadow-sm mt-1 block w-full h-[120px]">{{ old('daily_note') }}</textarea>
                                @error('daily_note')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('students.index') }}" 
                                   class="mr-4 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-300 hover:bg-gray-400 rounded-md shadow">
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //ngitung time
        function btnDuration() {
            const startDatetime = document.getElementById('subject_start_datetime').value;
            const endDatetime = document.getElementById('subject_end_datetime').value;
    
            if (startDatetime && endDatetime) {
                const startDate = new Date(startDatetime);
                const endDate = new Date(endDatetime);
    
                const diffTime = endDate - startDate;
    
                if (diffTime > 0) {
                    const totalMinutes = Math.floor(diffTime / 60000);
                    const days = Math.floor(totalMinutes / 1440);
                    const hours = Math.floor((totalMinutes % 1440) / 60);
                    const minutes = totalMinutes % 60;

                    document.getElementById('total-duration').innerText = `${days} Days ${hours} Hours ${minutes} Minutes`;
                } else {
                    document.getElementById('total-duration').innerText = "Data Tidak Benar!";
                    
                    setTimeout(function() {
                        document.getElementById('total-duration').innerText = '0 Days 0 Hours 0 Minutes';
                    }, 3000); 
                }
            } else {

            }
        }
        //reset button time start, end
    
        function btnReset() {
            document.getElementById('subject_start_datetime').value = '';
            document.getElementById('subject_end_datetime').value = '';
            
            document.getElementById('total-duration').innerText = '0 Days 0 Hours 0 Minutes';
        }

        function previewImage(inputId, imgId) {
        const fileInput = document.getElementById(inputId);
        const imagePreview = document.getElementById(imgId);
        
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            

            reader.onload = function(e) {
                imagePreview.src = e.target.result; 
            }
            
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
    //google map gagal
    let map;
    let marker;
    let isSettingStartLocation = true; 

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -6.200000, lng: 106.816666 },
            zoom: 13,
        });

        map.addListener("click", (event) => {
            setMarker(event.latLng); 
        });
    }

    function setMarker(location) {
        if (marker) marker.setMap(null);
        marker = new google.maps.Marker({
            position: location,
            map: map,
        });

        if (isSettingStartLocation) {
            document.getElementById("location_start").value = location.lat() + ", " + location.lng();
        } else {
            document.getElementById("location_end").value = location.lat() + ", " + location.lng();
        }
    }

    document.getElementById("setStartLocation").addEventListener("click", () => {
        isSettingStartLocation = true;
        if (marker) marker.setMap(null); 
    });

    document.getElementById("setEndLocation").addEventListener("click", () => {
        isSettingStartLocation = false;
        if (marker) marker.setMap(null); 
    });
    //get location
        function getLocation() {
            if ("geolocation" in navigator) {
            console.log("Geolocation is available")
            } else {
            console.log("Geolocation is not available")
            }
            if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                // Get latitude and longitude
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                console.log(latitude, longitude)
                // Update the input field's value
                const locationInput = document.getElementById('location_start');
                locationInput.value = `${latitude},${longitude}`;
            }, (error) => {
                console.error("Error getting location:", error.message);
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
        }
    
    </script>
    https://www.google.com/maps/@-8.5839768,115.2886348,15.75z?hl=id&entry=ttu&g_ep=EgoyMDI0MTAyOS4wIKXMDSoASAFQAw%3D%3D
</x-app-layout>