/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

//window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*const app = new Vue({
    el: '#app',
});*/

window.logout = function(){
	$('#logout-form').submit();
}

function validateFields(fields){
	var field, index, response, val, element, alert, errors;

	errors = 0;

	for(index in fields){
		field = fields[index];

		response = true;

		element = $('#' + field['name']);
		
		alert = $('#alert-' + field['name']);

		switch(field['type']){
			case 'text':
				if(element.val() == '') response = false;
				break;
			case 'email':
				if(!validateEmail(element.val())) response = false;
				break;
		}

		if(response){
			element.removeClass('error-input');
			alert.fadeOut();
		}else{
			element.addClass('error-input');
			alert.fadeIn();
			errors++;
		}
	}

	return errors == 0 ? true : false;
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function collectData(fields){
	var field, data = {};

	for(index in fields){
		field = fields[index];

		data[field['name']] = $('#' + field['name']).val();
	}

	return data;
}

window.editPhoto = function (name, type){
	$('#edit-' + name).find('input[type=file]').prop("disabled", true);
	$('#edit-' + name).find('button').html("<i class='fas fa-ellipsis-h mr-2'></i>Guardando");

	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('image', $('#edit-' + name).find('input[type=file]')[0].files[0]);
	formData.append('name', name);
	formData.append('type', type);

	$.ajax({
		url: '/images_upload',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		$('#edit-' + name).find('button').html("<i class='fas fa-check mr-2'></i>Guardado");
		window.location.reload();
	}).fail(function(result){
		$('#edit-' + name).find('button').html("<i class='fas fa-times mr-2'></i>Ha ocurrido un error");
	});
}

window.editing = null;
window.operation = null;

window.loadPhoto = function(id){
	$('#' + id + ' .fake-file').find('input[type=file]').prop("disabled", true);
	$('#' + id + ' .fake-file').find('button').html("<i class='fas fa-check mr-2'></i>Imagen Cargada");
}

$('#modal-member').on('show.bs.modal', function (event){
	operation = $(event.relatedTarget).data('operation');

	switch(operation){
		case 'add':
			$(this).find('.modal-title-main').text('Añadir');
			break;
		case 'edit':
			editing = $(event.relatedTarget).data('id');

			$(this).find('.modal-title-main').text('Editar');

			$(this).find('.name').val($('#member-' + editing).find('.name').text());
			$(this).find('.position').val($('#member-' + editing).find('.position').text());
			break;
	}
});

$('#modal-member').on('hidden.bs.modal', function (){
	$(this).find('input[type=file]').val('');
	$(this).find('input[type=file]').prop("disabled", false);
	$(this).find('.fake-file button').html("<i class='fas fa-camera mr-2'></i>Subir Imagen");

	$(this).find('.name').val('');
	$(this).find('.position').val('');
});

window.saveMemberData = function(){
	var fields = [
		{
			'name': 'edit-member-name',
			'type': 'text'
		},
		{
			'name': 'edit-member-position',
			'type': 'text'
		}
	]

	if(validateFields(fields)){
		switch(operation){
			case 'add':
				if($('#modal-member input[type=file]')[0].files.length != 0){
					addMember();	
				}else{
					alert('Recuerda seleccionar una foto');
				}						
				break;
			case 'edit':
				editMember();
				break;
		}
	}
}

window.addMember = function(){
	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('image_type', 'members');
	formData.append('image', $('#modal-member').find('input[type=file]')[0].files[0]);
	formData.append('name', $('#modal-member').find('.name').val());
	formData.append('position', $('#modal-member').find('.position').val());

	$.ajax({
		url: '/member/create',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		console.log(result);
		window.location.reload();
	}).fail(function(result){
		console.log(result);
		alert("Ha ocurrido un error al actualizar la información");	
	});
}

window.editMember = function(){
	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('id', editing);
	formData.append('image_type', 'members');
	formData.append('image', $('#modal-member').find('input[type=file]')[0].files[0]);
	formData.append('name', $('#modal-member').find('.name').val());
	formData.append('position', $('#modal-member').find('.position').val());

	$.ajax({
		url: '/member/edit',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		console.log(result);
		window.location.reload();
	}).fail(function(result){
		console.log(result);
		alert("Ha ocurrido un error al actualizar la información");	
	});
}

window.removeMember = function(id){
	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('id', id);

	$.ajax({
		url: '/member/remove',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		console.log(result);
		window.location.reload();
	}).fail(function(result){
		console.log(result);
		alert("Ha ocurrido un error al borrar la información");	
	});
}

$('#modal-event').on('show.bs.modal', function (event){
	operation = $(event.relatedTarget).data('operation');

	switch(operation){
		case 'add':
			$(this).find('.modal-title-main').text('Añadir');
			break;
		case 'edit':
			editing = $(event.relatedTarget).data('id');

			$(this).find('.modal-title-main').text('Editar');

			console.log($('#event-' + editing).find('.end_date').text());

			$(this).find('.title').val($('#event-' + editing).find('.title').text());			
			$(this).find('.start_date').val($('#event-' + editing).find('.start_date').text());
			$(this).find('.end_date').val($('#event-' + editing).find('.end_date').text());

			$(this).find('.description').summernote('code', 'Obteniendo descripción...');

			var summernote = $(this).find('.description');

			$.ajax({
				url: '/event/description/' + editing,
				type: 'GET',
				dataType : 'json',
			}).done(function(result){
				console.log(result);
				summernote.summernote('code', result['description']);
			}).fail(function(result){
				console.log(result);
				summernote.summernote('code', 'Ha ocurrido un error al obtener la descripción');	
			});
			break;
	}
});

$('#modal-event').on('hidden.bs.modal', function (){
	$(this).find('input[type=file]').val('');
	$(this).find('input[type=file]').prop("disabled", false);
	$(this).find('.fake-file button').html("<i class='fas fa-camera mr-2'></i>Subir Imagen");

	$(this).find('.title').val('');
	$(this).find('.description').summernote('code', '');
	$(this).find('.start_date').val('');
	$(this).find('.end_date').val('');
});

window.saveEventData = function(){
	var fields = [
		{
			'name': 'edit-event-title',
			'type': 'text'
		},
		{
			'name': 'edit-event-description',
			'type': 'text'
		},
		{
			'name': 'edit-event-start_date',
			'type': 'text'
		},
		{
			'name': 'edit-event-end_date',
			'type': 'text'
		},
		{
			'name': 'edit-event-place',
			'type': 'text'
		}
	]

	if(validateFields(fields)){
		switch(operation){
			case 'add':
				if($('#modal-event .fake-file input[type=file]')[0].files.length != 0){
					addEvent();	
				}else{
					alert('Recuerda seleccionar una foto');
				}						
				break;
			case 'edit':
				editEvent();
				break;
		}
	}
}

window.addEvent = function(){
	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('image_type', 'events');
	formData.append('image', $('#modal-event').find('.fake-file input[type=file]')[0].files[0]);
	formData.append('title', $('#modal-event').find('.title').val());
	formData.append('description', $('#modal-event').find('.description').summernote('code'));
	formData.append('start_date', $('#modal-event').find('.start_date').val());
	formData.append('end_date', $('#modal-event').find('.end_date').val());

	$.ajax({
		url: '/event/create',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		console.log(result);
		window.location.reload();
	}).fail(function(result){
		console.log(result);
		alert("Ha ocurrido un error al guardar la información");	
	});
}

window.editEvent = function(){
	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('id', editing);
	formData.append('image_type', 'events');
	formData.append('image', $('#modal-event').find('.fake-file input[type=file]')[0].files[0]);
	formData.append('title', $('#modal-event').find('.title').val());
	formData.append('description', $('#modal-event').find('.description').summernote('code'));
	formData.append('start_date', $('#modal-event').find('.start_date').val());
	formData.append('end_date', $('#modal-event').find('.end_date').val());

	$.ajax({
		url: '/event/edit',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		console.log(result);
		window.location.reload();
	}).fail(function(result){
		console.log(result);
		alert("Ha ocurrido un error al guardar la información");	
	});
}

window.removeEvent = function(id){
	var formData = new FormData();
	formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
	formData.append('id', id);

	$.ajax({
		url: '/event/remove',
		type: 'POST',
		processData: false,
		contentType: false,
		dataType : 'json',
		data: formData
	}).done(function(result){
		console.log(result);
		window.location.reload();
	}).fail(function(result){
		console.log(result);
		alert("Ha ocurrido un error al borrar la información");	
	});
}

window.sendMessage = function(){
	var fields = [
		{
			'name': 'name',
			'type': 'text'
		},
		{
			'name': 'email',
			'type': 'email'
		},
		{
			'name': 'subject',
			'type': 'text'
		},
		{
			'name': 'message_content',
			'type': 'text'
		}
	]

	if(validateFields(fields)){
		var formData = new FormData();
		formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
		formData.append('name', $('#name').val());
		formData.append('email', $('#email').val());
		formData.append('subject', $('#subject').val());
		formData.append('message_content', $('#message_content').val());

		$.ajax({
			url: '/message/send',
			type: 'POST',
			processData: false,
			contentType: false,
			dataType : 'json',
			data: formData
		}).done(function(result){
			console.log(result);
			alert("Mensaje enviado");
			window.location.reload();
		}).fail(function(result){
			console.log(result);
			alert("Ha ocurrido un error al enviar el mensaje");	
		});
	}
}