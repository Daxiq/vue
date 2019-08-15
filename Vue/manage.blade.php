@extends('layouts.app')

@section('content')

<div class="modal fade" id="eventDetail">
    <div class="modal-dialog">
        <div class="modal-content">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Title</th>
                        <td class="event-title">@{{event.title}}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td class="event-description">@{{event.description}}</td>
                    </tr>
                    <tr>
                        <th>Date</th>
                        <td class="event-date">@{{event.date}}</td>
                    </tr>
                    <tr>
                        <th>Time</th>
                        <td class="event-time">@{{event.time}}</td>
                    </tr>
                    <tr>
                        <th>Duration (days)</th>
                        <td class="event-duration-days">@{{event.duration_days}}</td>
                    </tr>
                    <tr>
                        <th>Location</th>
                        <td class="event-location">@{{event.location}}</td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td class="event-price">@{{event.standard_price}}</td>
                    </tr>
                    <tr>
                        <th>Capacity</th>
                        <td class="event-capacity">@{{event.capacity}}</td>
                    </tr>
                    <tr>
                        <th>Sessions</th>
                        <td class="event-sessions">
                            <button class="btn btn-outline-secondary" data-toggle='modal' @click='showSessionsModal(event.id)'>See Sessions</button>
                        </td>
                    </tr>
                </tbody>
            </table>
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

<div class="modal fade" id="createEvent">
    <div class="modal-dialog">
        <div class="modal-content">
            <form @submit.prevent='createEvent'>
                <div class="modal-header"><h2>Add Event</h2></div>
                <div class="modal-body">
                    <div class="form-row">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" type="text" v-model="createForm.title">
                    </div>

                    <div class="form-row">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" v-model="createForm.description"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="date">Date</label>
                            <input class="form-control" id="date" type="date" v-model="createForm.date">
                        </div>
                        <div class="col">
                            <label for="time">Time</label>
                            <input class="form-control" id="time" type="time" v-model="createForm.time">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="duration_days">Duration (days)</label>
                            <input class="form-control" id="duration_days" type="number" v-model="createForm.duration_days">
                        </div>
                        <div class="col">
                            <label for="location">Location</label>
                            <input class="form-control" id="location" type="text" v-model="createForm.location">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="standard_price">Price</label>
                            <input class="form-control" id="standard_price" type="number" v-model="createForm.standard_price">
                        </div>
                        <div class="col">
                            <label for="capacity">Capacity</label>
                            <input class="form-control" id="capacity" type="number" v-model="createForm.capacity">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Add Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateEvent">
    <div class="modal-dialog">
        <div class="modal-content">
            <form @submit.prevent='updateEvent'>
                <div class="modal-header"><h2>Update @{{event.title}}</h2></div>
                <div class="modal-body">
                    <div class="form-row">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" type="text" v-model="updateForm.title">
                    </div>

                    <div class="form-row">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" v-model="updateForm.description"></textarea>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="date">Date</label>
                            <input class="form-control" id="date" type="date" v-model="updateForm.date">
                        </div>
                        <div class="col">
                            <label for="time">Time</label>
                            <input class="form-control" id="time" type="time" v-model="updateForm.time">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="duration_days">Duration (days)</label>
                            <input class="form-control" id="duration_days" type="number" v-model="updateForm.duration_days">
                        </div>
                        <div class="col">
                            <label for="location">Location</label>
                            <input class="form-control" id="location" type="text" v-model="updateForm.location">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <label for="standard_price">Price</label>
                            <input class="form-control" id="standard_price" type="number" v-model="updateForm.standard_price">
                        </div>
                        <div class="col">
                            <label for="capacity">Capacity</label>
                            <input class="form-control" id="capacity" type="number" v-model="updateForm.capacity">
                        </div>
                    </div>
                    <div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Speaker</th>
                                    <th>Action</th>
                                </tr>
                                <tr v-for="session in sessions">
                                    <td>@{{session.event_id}}</td>
                                    <td>@{{session.title}}</td>
                                    <td>@{{session.room}}</td>
                                    <td>@{{session.speaker}}</td>
                                    <td><button type="button" class="btn btn-outline-secondary" @click='showUpdateSession(session, session.id)'>Update</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-toggle="modal" @click='showCreateSession(event.id)'>Add Session</button>
                    <button type="submit" class="btn btn-outline-primary">Add Event</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="createSession">
    <div class="modal-dialog">
        <div class="modal-content">
            <form @submit.prevent='createSession'>
                <div class="modal-header"><h2>Add Session</h2></div>
                <div class="modal-body">
                    <div class="form-row">
                        <input class="form-control" id="event_id" type="text" v-model="createForm.event_id">
                    </div>
                    <div class="form-row">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" type="text" v-model="createForm.title">
                    </div>
                    <div class="form-row">
                        <label for="location">Location</label>
                        <input class="form-control" id="room" type="text" v-model="createForm.location">
                    </div>
                    <div class="form-row">
                        <label for="speaker">Speaker</label>
                        <input class="form-control" id="speaker" type="text" v-model="createForm.speaker">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-primary">Add Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateSession">
    <div class="modal-dialog">
        <div class="modal-content">
            <form @submit.prevent='updateSession'>
                <div class="modal-header"><h2>Update session</h2></div>
                <div class="modal-body">
                    <div class="form-row">
                        <label for="title">Title</label>
                        <input class="form-control" id="title" type="text" v-model="updateForm.session_title">
                    </div>

                    <div class="form-row">
                        <label for="room">Room</label>
                        <input class="form-control" id="room" type="text" v-model="updateForm.session_room">
                    </div>


                    <div class="form-row">
                        <label for="speaker">Speaker</label>
                        <input class="form-control" id="speaker" type="text" v-model="updateForm.session_speaker">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-dark">Update Session</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-between mb-4">
        <h2>My Events</h2>
        <d class="d-flex">
            <a href="{{ url('/home') }}"><button class="btn btn-outline-primary mr-3">Home</button></a>
            @if(Auth::user()->is_admin == 1)
                <a href="manage" data-toggle="modal" data-target="#createEvent"><button class="btn btn-outline-primary">Add Event</button></a>
            @endif
        </d>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->is_admin == 1)
                        <tr class="event" v-for='event in events'>
                            <td class="event-title">
                                <a href="#!" @click='showUpdateEvent(event, event.id)'>@{{event.title}}</a>
                            </td>
                            <td class="event-date">@{{event.date}}</td>
                            <td class="event-price">@{{event.standard_price}}</td>
                            <td class="event-actions">
                                <a class="event-participants btn btn-outline-dark" @click='showEventRegistrations(event.id)'>Attendee list</a>
                                <a class="event-ratings btn btn-outline-primary" href="#!">Rating diagram</a>
                            </td>
                        </tr>
                    @else
                        <tr class="event" v-for='registration in registrations'>
                            <td class="event-title">
                                <a href="#!" @click='showEventModal(registration.event_id)'>@{{registration.title}}</a>
                            </td>
                            <td class="event-date">@{{registration.date}}</td>
                            <td class="event-price">@{{registration.calculate_price}}</td>
                            <td class="event-actions">
                                <button type="button" class="btn btn-outline-dark">Ical</button>
                                <select class="btn btn-outline-primary">Rating diagram
                                    <option disabled selected>- Rate event -</option>
                                    <option value="0">Bad</option>
                                    <option value="1">Good</option>
                                    <option value="2">Excellent</option>
                                </select>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
