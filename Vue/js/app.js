const app = new Vue({
	el: '#app',
	data(){
		return{
			o_events:[],
			events:[],
			event:[],
			o_sessions:[],
			sessions:[],
			session:[],
			o_registrations:[],
			registrations:[],
			type: '',
			search: '',
			createForm:{
				// Events
				title: null,
				description: null,
				date: null,
				time: null,
				duration_days: null,
				location: null,
				standard_price: null,
				capacity: null,
				// Sessions
				event_id: null,
				room: null,
				speaker: null,
			},
			updateForm:{
				id: null,
				// Events
				title: null,
				description: null,
				date: null,
				time: null,
				duration_days: null,
				location: null,
				standard_price: null,
				capacity: null,
				// Sessions
				session_title: null,
				session_event_id: null,
				session_room: null,
				session_speaker: null,
				// Registrations
				event_rating: null,
			},
			registerForm:{
				event_id: null,
				registartion_type: null,
				type: null,
				registation_date: null,
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
				this.registrations = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		showEventModal(id){
			axios
			.get('http://localhost/PHPandJS813/public/api/event/'+id)
			.then((res)=>{
				this.o_events = res.data;
				this.event = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
			$('#eventDetail').modal();
		},
		showSessionModal(id){
			axios
			.get('http://localhost/PHPandJS813/public/api/session/'+id)
			.then((res)=>{
				this.o_sessions = res.data;
				this.session = res.data;
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
			$('#sessionDetail').modal();
		},
		showCreateRegistration(event, id){
			axios
			.get('http://localhost/PHPandJS813/public/api/event/'+id)
			.then((res)=>{
				this.o_events = res.data;
				this.event = res.data;
			})
			.catch((err)=>{
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

			$('#registerEvent').modal();
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
			this.updateForm.session_room = session.title;
			this.updateForm.session_sepaker = session.title;

			$('#updateEvent').modal();
		},
		createEvent(){
			axios
			.post('http://localhost/PHPandJS813/public/api/event', this.createForm)
			.then((ress)=>{
				this.setEvents();
				$('#createEvent').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		createSession(){
			axios
			.post('http://localhost/PHPandJS813/public/api/session', this.createForm)
			.then((ress)=>{
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
			.then((ress)=>{
				this.setRegistrations();
			})
			.catch((err)=>{
				console.log(err.response.data);
			});

			alert('Register');
			$('#registerEvent').modal('hide');
		},
		updateEvent(event){
			axios
			.put('http://localhost/PHPandJS813/public/api/event' + this.event.id, this.updateForm)
			.then((ress)=>{
				this.setEvents();
				$('#updateEvent').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},
		updateSession(session){
			axios
			.put('http://localhost/PHPandJS813/public/api/session' + this.session.id, this.updateForm)
			.then((ress)=>{
				this.setSessions();
				$('#updateSession').modal('hide');
			})
			.catch((err)=>{
				console.log(err.response.data);
			});
		},

	},
	watch:{
		search(val){
			this.events = this.o_events.filter((event)=>{
				let reg = new RegExp(val, 'i');

				return reg.test(event.date);
			});
		},
		type(){
			this.registartion_type = this.type;
			this.createForm.calculate_price  = this.event.standard_price * this.type;
			this.createForm.registartion_type = this.type;
		},

	},
	created(){
		console.log('created')
	},
	mounted(){
		this.setEvents();
		this.setSessions();
		this.setRegistrations();
		console.log('mounted')
	},
	updated(){
		console.log('updated')
	},
	destroyed(){
		console.log('destroyed')
	},
});