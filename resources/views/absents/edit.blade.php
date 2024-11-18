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
                    <form action="{{ route('absents.update', $absent->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 gap-6">
                            <!--Student ID -->
                            <div>
                                <label for="student_id" class="block font-medium text-sm text-gray-700">Student</label>
                                <select name="student_id" id="student_id"
                                        class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" disabled selected>Select Student</option>
                                    <option value="{{ $absent->detail_subject_id }}" disabled selected>{{ $absent->detail_subject_id }}</option>
                                </select>
                                @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!--Subject ID -->
                            <div>
                                <label for="subject_id" class="block font-medium text-sm text-gray-700">Subject</label>
                                <select name="subject_id" id="subject_id"
                                        class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" disabled selected>Select Subject</option>
                                    <option value="{{ $absent->detail_subject_id }}" disabled selected>{{ $absent->detail_subject_id }}</option>
                                </select>
                                @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                                <select name="status" id="status"
                                        class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="{{ $absent->status }}" disabled selected>{{ $absent->status }}</option>
                                </select>
                                @error('status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex items-center gap-[20px] w-full">
                                <div class="w-full">
                                    <div>
                                        <label for="subject_start_datetime"
                                               class="block font-medium text-sm text-gray-700">Start Date Time</label>
                                        <input type="datetime-local" name="subject_start_datetime"
                                               id="subject_start_datetime"
                                               class="form-input rounded-md shadow-sm mt-1 block w-full"
                                               value="{{ $absent->subject_start_datetime }}"
                                        disabled>
                                        @error('subject_start_datetime')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="subject_end_datetime"
                                               class="block font-medium text-sm text-gray-700">End Date Time</label>
                                        <input type="datetime-local" name="subject_end_datetime"
                                               id="subject_end_datetime"
                                               class="form-input rounded-md shadow-sm mt-1 block w-full"
                                               value="{{ $absent->subject_end_datetime }}">
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
                                        <button type="button" onclick="btnDuration()"
                                                class="mt-2 w-[45%] py-2 bg-blue-500 text-white rounded-md">Hitung
                                        </button>
                                        <button type="button" onclick="btnReset()"
                                                class="mt-2 w-[45%] py-2 bg-red-500 text-white rounded-md">Reset
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex w-full gap-[20px]">
                                <div class="w-full">
                                    <div>
                                        <label for="proof_photo_start" class="block font-medium text-sm text-gray-700">Photo
                                            Start</label>
                                        <input type="file" name="proof_photo_start" id="proof_photo_start"
                                               class="form-input rounded-md shadow-sm mt-1 block w-full"
                                               accept=".png, .jpg, .jpeg"
                                               onchange="validateFile(this, 'img_start')"
                                        disabled>
                                        @error('proof_photo_start')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <div class="w-[280px] h-[280px] border-black border rounded-md ">
                                            <img id="img_start" src="{{ storage_path( $absent->proof_photo_start ) }}" alt="Belum Ada Gambar"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full">
                                    <div>
                                        <label for="proof_photo_end" class="block font-medium text-sm text-gray-700">Photo
                                            End</label>
                                        <input type="file" name="proof_photo_end" id="proof_photo_end"
                                               class="form-input rounded-md shadow-sm mt-1 block w-full"
                                               onchange="previewImage('proof_photo_end', 'img_end')">
                                        @error('proof_photo_end')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <div class="w-[280px] h-[280px] border-black border rounded-md">
                                            <img id="img_end" src="{{ storage_path( $absent->proof_photo_end ) }}" alt="Belum Ada Gambar"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="flex gap-[10px]">
                                    <div class="w-full">
                                        <label for="location_start" class="block font-medium text-sm text-gray-700">Location
                                            Start</label>
                                        <input type="text" name="location_start" id="location_start"
                                               class="form-input rounded-md shadow-sm mt-1 block w-full"
                                               value="{{ $absent->location_start }}" disabled>
                                        @error('location_start')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-full">
                                        <label for="location_end" class="block font-medium text-sm text-gray-700">Location
                                            End</label>
                                        <input type="text" name="location_end" id="location_end"
                                               class="form-input rounded-md shadow-sm mt-1 block w-full"
                                               value="{{ $absent->location_end }}">
                                        @error('location_end')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{--                                <div id="map" class="border border-black w-full h-[500px] mt-[20px]"></div>--}}
                                <div class="flex mt-2">
                                    <a href="#" onclick="getLocation('start')" id="setStartLocation"
                                       class="w-full bg-blue-800 text-center py-2 text-white rounded-md disabled">Set Start
                                        Location</a>
                                    <a href="#" onclick="getLocation('end')" id="setEndLocation"
                                       class="w-full bg-blue-800 text-center py-2 text-white rounded-md">Set End
                                        Location</a>
                                    {{--                                    <button id="setEndLocation" class="w-full bg-blue-800 text-center py-2 text-white rounded-md">Set End Location</button>--}}
                                </div>
                            </div>


                            <div>
                                <label for="daily_report" class="block font-medium text-sm text-gray-700">Daily
                                    Report</label>
                                <textarea placeholder="Please Insert Dialy Report Student With List Number"
                                          name="daily_report" id="daily_report"
                                          class="form-input resize-none  rounded-md shadow-sm mt-1 block w-full h-[120px]">{{ $absent->daily_report }}</textarea>
                                @error('daily_report')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="daily_note" class="block font-medium text-sm text-gray-700">Daily
                                    Note</label>
                                <textarea placeholder="Please Insert Dialy Note Student With List Number"
                                          name="daily_note" id="daily_note"
                                          class="form-input resize-none  rounded-md shadow-sm mt-1 block w-full h-[120px]">{{ $absent->daily_note }}</textarea>
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
                                    End Absent
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

                    setTimeout(function () {
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


                reader.onload = function (e) {
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
                center: {lat: -6.200000, lng: 106.816666},
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
        var location_type;

        function getLocation(location_type) {
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
                    if (location_type === 'start') {
                        const locationInput = document.getElementById('location_start');
                        locationInput.value = `${latitude},${longitude}`;
                    } else {
                        const locationInput = document.getElementById('location_end');
                        locationInput.value = `${latitude},${longitude}`;
                    }
                }, (error) => {
                    console.error("Error getting location:", error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        //img function
        function validateFile(input, imgId) {
            const file = input.files[0];
            const maxSize = 2 * 1024 * 1024; // 5 MB in bytes

            // Check file size
            if (file && file.size > maxSize) {
                alert('Batas File Adalah 2 MB.');
                input.value = ''; // Clear the input if file size is too large
                return;
            }

            // Preview image (optional)
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(imgId).src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
