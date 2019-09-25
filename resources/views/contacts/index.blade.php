@extends('base')

@section('content')
    <div class="home-page mt-4">
        <h2 class="float-left">Contacts</h2>
        <div>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#newContactModal">
                Create New
            </button>
            <div class="clear"></div>
        </div>
        <div>
            <table class="data-table">
                @if($contacts->isEmpty())
                    No Question Templates Created Click Here to Add One!
                @else
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$contact->first_name}}</td>
                            <td>{{$contact->last_name}}</td>
                            <td>{{$contact->Email}}</td>
                            <td><a href="{{route('viewContact', ['id' => $contact->id])}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
    </div>

    @include('modals/new_contact_modal')
@endsection
