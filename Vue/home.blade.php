@extends('layouts.app')

@section('content')

<div class="modal fade" id="registerEvent">
    <div class="modal-dialog">
        <div class="modal-content">
            <form @submit.prevent='registerEvent(event)'>
                <div class="modal-header"><h2>Register for @{{event.title}}</h2></div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="form-group">
                            <select class="form-control" v-model='type'>
                                <option value="">- select type of ticket -</option>
                                <option value="0.85">Early Bird (15% off of regular price)</option>
                                <option value="1">Standard</option>
                                <option value="1.20">VIP (pay and get 20% more)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="calculate_price">You pay: ₽</label>
                            <input type="number" step="0.1" readonly v-model='createForm.calculate_price' id="calculate_price">
                        </div>

                        <div class="form-group">
                            <input type="hidden" aria-hidden='true' value="{!!Auth::id()!!}" id="user_id_value">
                            <input type="hidden" aria-hidden='true' v-model='createForm.user_id' name='user_id' id="user_id">

                            <input type="hidden" aria-hidden='true' step="0.1" v-model="createForm.registration_type" id="registration_type">
                            <input type="hidden" aria-hidden='true' v-model="createForm.event_id" id="event_id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"><b>Register Event</b></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="sessionModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><h2>Sessions</h2></div>
            <div class="modal-body">
                <ul v-for="session in sessions">
                    <li><b>@{{session.title}}</b></li>
                    <li>Location: @{{session.room}}</li>
                    <li>Speaker: @{{session.speaker}}</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-between mb-4">
        <h2>Events</h2>
        <d class="d-flex">
            <input type="date" id="search" class="form-control mr-3">
            <a href="{{ url('/manage') }}"><button class="btn btn-outline-primary">My Events</button></a>
        </d>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-deck">
                <div class="col-12 col-lg-6 my-2" v-for="event in events">
                    <div class="card">
                        <div class="card-header"><h4>@{{event.title}}</h4></div>
                        <div class="card-body">
                            <p>@{{event.description}}</p>
                            <p>On @{{event.date}} form @{{event.time}} for @{{event.duration_days}} day(s)</p>
                            <p>Meet at @{{event.location}}</p>
                            <p>Pay &#8381;@{{event.standard_price}}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-around">
                            <button class="btn btn-outline-secondary" data-toggle='modal' @click='showSessionsModal(event.id)'>See Sessions</button>
                            <button class="btn btn-outline-primary" data-toggle='modal' @click='showRegisterModal(event, event.id)'>Go to Registration</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
