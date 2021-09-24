@extends('partials.admin_partials')
@section('admin_content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="home"></i></div>
                                {{ __('Office Profile') }}
                            </h1>
                            <div class="page-header-subtitle">{{ __('Employee Attendance App') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="container mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block mb-2">
                                    <button type="button" class="close" data-dismiss="alert">×</button>    
                                    {{ $message }}
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block mb-2">
                                    <button type="button" class="close" data-dismiss="alert">×</button>    
                                    {{ $message }}
                                </div>
                            @endif
                    <form action="{{ route('adm.updateofficeprofile', $dataoffice->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label class="small mb-1" for="name">{{ __('Office Name') }}</label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="Office Name" required value="{{ $dataoffice->name }}"/>
                                    @if(session()->has('name'))<p class="text-danger">{{session('name')}}</p>@endif
                                </div>
                            </div>
                            <input class="form-control" id="langitude" name="langitude" type="text" hidden required value="{{ $dataoffice->langitude }}"/>
                            <input class="form-control" id="longitude" name="longitude" type="text" hidden required value="{{ $dataoffice->longitude }}"/>
                        </div>
                        <div id="mapid" style="height: 500px;"></div>
                        <hr class="my-4" />
                        <button class="btn btn-primary lift" type="submit">Save</button>
                        <a class="btn btn-danger lift" href="javascript:history.go(-1)">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('after-script')
    <script>
        var latitudeawal = document.getElementById("langitude").value;
        var longitudeawal = document.getElementById("longitude").value;
        var mymap = L.map('mapid').setView([latitudeawal, longitudeawal], 14);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
        }).addTo(mymap);
        mymap.attributionControl.setPrefix(false);
        var curLocation = [latitudeawal, longitudeawal];
        var latInput = document.querySelector("[name=langitude]");
        var longInput = document.querySelector("[name=longitude]");
        var marker = new L.marker(curLocation , {
            draggable:'true'
        });
        marker.on('dragend' , function(event){
            var position = marker.getLatLng();
            marker.setLatLng(position , {
                draggable : 'true'
            }).bindPopup(position).update();
            console.log(position);
            $("#langitude").val(position.lat);
            $("#longitude").val(position.lng);
        });
        mymap.addLayer(marker);
        mymap.on("click" , function(e){
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if(!marker){
                marker = L.marker(e.latlng).addTo(mymap);
            }else {
                marker.setLatLng(e.latlng);
            }
            latInput.value= lat;
            longInput.value= lng;
        });
    </script>
@endpush