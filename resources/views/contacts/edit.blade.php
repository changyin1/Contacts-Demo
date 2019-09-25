@extends('base')

@section('content')
    <div class="contact-page container mt-4">
        <h2>Contact: {{$contact->first_name . ' ' . $contact->last_name}}</h2>
        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#deleteContactModal">
            Delete Contact
        </button>
        <div class="clearfix"></div>
        <div>
            <form id="update-contact-form" class="ajax update-form" action="{{route('updateContact')}}" method="post">
                @csrf
                <br>
                <div class="form-body">
                    <input type="hidden" name="id" value="{{$contact->id}}">
                    <div class="errors"></div>
                    <div class="form-body">
                        <div class="form-group">
                            <input name="first_name" id="first_name" class="form-control" type="text" value="{{$contact->first_name}}" required>
                            <label class="control-label" for="first_name">First Name</label>
                        </div>
                        <div class="form-group">
                            <input name="last_name" id="last_name" class="form-control" type="text" value="{{$contact->last_name}}" required>
                            <label class="control-label" for="last_name">Last Name</label>
                        </div>
                        <div class="form-group">
                            <input name="email" id="email" class="form-control" type="text" value="{{$contact->email}}" required>
                            <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="form-group">
                            <input name="phone" id="phone" class="form-control" value="{{$contact->phone}}" type="text">
                            <label class="control-label" for="phone">Phone</label>
                        </div>
                        <div class="form-group">
                            <input name="birthday" id="birthday" class="form-control" value="{{$contact->birthday}}" type="text">
                            <label class="control-label" for="birthday">Birthday</label>
                        </div>
                        <div class="form-group">
                            <input name="city" id="address" class="form-control" value="{{$contact->address}}" type="text">
                            <label class="control-label" for="address">Address</label>
                        </div>
                        <div class="form-group">
                            <input name="city" id="city" class="form-control" value="{{$contact->city}}" type="text">
                            <label class="control-label" for="city">City</label>
                        </div>
                        <div class="form-group">
                            <input name="state" id="state" class="form-control" value="{{$contact->state}}" type="text">
                            <label class="control-label" for="state">State</label>
                        </div>
                        <div class="form-group">
                            <input name="zip" id="zip" class="form-control" value="{{$contact->zip}}" type="text">
                            <label class="control-label" for="email">Zip</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-submit" value="Update">
                    </div>
                </div>
            </form>
        </div>
        <div class="mb-4">
            <div id="map"></div>
        </div>
    </div>
    <script>
        // Initialize and add the map
        var geocoder;
        var map;
        function initMap() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 8,
                center: latlng
            }
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            codeAddress();
        }

        function codeAddress() {
            var address = $('#address').val();
            geocoder.geocode( { 'address': address}, function(results, status) {
                if (status == 'OK') {
                    map.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }
    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNek_OiBxR6ZmQpVYXuFQTcFxR2uMR1AU&callback=initMap">
    </script>
    @include('modals/alert_modal', ['title' => 'Delete Contact: ' . $contact->first_name . ' ' . $contact->last_name, 'formRoute' => route('deleteContact'), 'hiddenValues' => ['contact_id' => $contact->id], 'modalId' => 'deleteContactModal'])
@endsection