const app = new Vue({
	el: '#app',
	data(){
		return{
			o_events: [],
			events:[],
			event:[],
			o_sessions:[],
			sessions: [],
			session: [],
			o_registrations: [],
			registrations: [],
			type: '',
			createForm: {
				title : null,
				description : null,
				date : null,
				time : null,
				duration_days : null,
				location : null,
				standard_price : null,
				capacity : null,

				event_id: null,
				location: null,
				speaker: null,
			},
			updateForm: {
				id: null,
				title : null,
				description : null,
				date : null,
				time : null,
				duration_days : null,
				location : null,
				standard_price : null,
				capacity : null,

				session_title : null,
				session_room: null,
				session_speaker: null,
			},
			registerForm:{
				event_id: null,
				registration_type: null,
				type: null,
				registration_date: null,
				calculate_price: null,
				event_rating: null,
			},
		};
	},
	methods:{
		setEvents(){
			axios
			.get('http://localhost/PHPandJS813/public/api/events')
			.then((res)=>{
				this.o_events = res.data;
				this.events = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		setSessions(){
			axios
			.get('http://localhost/PHPandJS813/public/api/sessions/0')
			.then((res)=>{
				this.o_sessions = res.data;
				this.sessions = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		setRegistrations(){
			var id = registration_id.value;
			axios
			.get('http://localhost/PHPandJS813/public/api/registrations/'+id)
			.then((res)=>{
					this.o_registrations = res.data;
					this.registrations = res.data
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		showEventModal(id){
			axios
			.get('http://localhost/PHPandJS813/public/api/event/'+ id)
			.then((res)=>{
				this.o_events = res.data;
				this.event = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

			$('#eventDetail').modal();
		},
		showSessionsModal(id){
			axios
			.get('http://localhost/PHPandJS813/public/api/sessions/'+id)
			.then((res)=>{
				this.o_sessions = res.data;
				this.sessions = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
			$('#sessionModal').modal();
		},
		showRegisterModal(event, id){
			axios
			.get('http://localhost/PHPandJS813/public/api/event/'+ id)
			.then((res) => {
				this.o_events = res.data;
				this.event = res.data;
			})
			.catch((err) =>{
				console.log(err.response.data);
			});

			this.createForm.user_id = user_id_value.value;
			this.createForm.event_id = id;

			$('#registerEvent').modal();
		},
		showCreateSession(id){
			axios
			.get('http://localhost/PHPandJS813/public/api/session/'+id)
			.then((res)=>{
				this.o_sessions = res.data;
				this.session = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

			this.createForm.event_id = id;
			/*this.createForm.title = title;
			this.*/

			$('#createSession').modal();
		},
		showUpdateEvent(event, id){
			axios
			.get('http://localhost/PHPandJS813/public/api/event/'+id)
			.then((res)=>{
				this.o_events = res.data;
				this.event = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
			axios
			.get('http://localhost/PHPandJS813/public/api/sessions/'+id)
			.then((res)=>{
				this.o_sessions = res.data;
				this.sessions = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

			this.updateForm.title = event.title;
			this.updateForm.description = event.description;
			this.updateForm.date = event.date;
			this.updateForm.time = event.time;
			this.updateForm.duration_days = event.duration_days;
			this.updateForm.location = event.location;
			this.updateForm.standard_price = event.standard_price;
			this.updateForm.capacity = event.capacity;

			$('#updateEvent').modal();
		},
		showUpdateSession(session, id){
			axios
			.get('http://localhost/PHPandJS813/public/api/session/'+id)
			.then((res)=>{
				this.o_sessions = res.data;
				this.session = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

			this.updateForm.session_title = session.title;
			this.updateForm.session_room = session.room;
			this.updateForm.session_speaker = session.speaker;

			$('#updateSession').modal();
		},
		createEvent(){
			axios
			.post('http://localhost/PHPandJS813/public/api/event', this.createForm)
			.then((res)=>{
				this.setEvents();
				$('#createEvent').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		createSession(){
			axios
			.post('http://localhost/PHPandJS813/public/api/session', + this.createForm)
			.then((res)=>{
				this.setSessions();
				$('#createSession').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

		},
		createRegistration(){
			axios
			.post('http://localhost/PHPandJS813/public/api/registration', this.createForm)
			.then((res)=>{
				this.setRegistrations();
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

			alert('Registered successfully');
			$('#registerEvent').modal('hide');
		},
		updateEvent(event){
			axios
			.put('http://localhost/PHPandJS813/public/api/event/' + this.event.id, this.updateForm)
			.then((res)=>{
				this.setEvents();
				$('#updateEvent').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		updateSession(session){
			axios
			.put('http://localhost/PHPandJS813/public/api/session/' + this.session.id, this.updateForm)
			.then((res)=>{
				this.setSessions();
				$('#updateSession').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
	},
	watch:{
		type(val){
			this.registration_type = this.type;
			this.createForm.calculate_price = this.event.standard_price * this.type;

			this.createForm.registration_type = this.type;
		}
	},
	created(){
		console.log('created');
	},
	mounted(){
		this.setEvents();
		this.setSessions();
		this.setRegistrations();
		console.log('mounted');
	},
	updated(){
		console.log('updated');
	},
	destroyed(){
		console.log('destroyed');
	},
});