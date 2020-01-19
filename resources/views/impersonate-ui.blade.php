@canImpersonate
<div id="impersonate-ui" class="position-{{ config('laravel-impersonate-ui.icon_position') }}">
	<a id="impersonate-ui-icon" onclick="toggleFull()">
		{!! '<?xml version="1.0" ?><svg height="24"  version="1.1" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"><g transform="translate(0 -1028.4)"><path d="m8.4062 1041.1c-2.8856 1.3-4.9781 4-5.3437 7.3 0 1.1 0.8329 2 1.9375 2h14c1.105 0 1.938-0.9 1.938-2-0.366-3.3-2.459-6-5.344-7.3-0.649 1.3-2.011 2.3-3.594 2.3s-2.9453-1-3.5938-2.3z" fill="#555"/><path d="m17 4a5 5 0 1 1 -10 0 5 5 0 1 1 10 0z" fill="#fff" transform="translate(0 1031.4)"/><path d="m12 11c-1.277 0-2.4943 0.269-3.5938 0.75-2.8856 1.262-4.9781 3.997-5.3437 7.25 0 1.105 0.8329 2 1.9375 2h14c1.105 0 1.938-0.895 1.938-2-0.366-3.253-2.459-5.988-5.344-7.25-1.1-0.481-2.317-0.75-3.594-0.75z" fill="#fff" transform="translate(0 1028.4)"/></g></svg>' !!}
	</a>
	<div id="impersonate-ui-fullcontainer" class="hiddenX">
		<h3 class="h5">Laravel Impersonate UI</h3>
		Logged on as: <span id="current-user"><strong>{{ Auth::user()->name }}</strong></span><br>
		@impersonating
			Real user: <span id="real-user"><strong>{{ $impersonator->name }}</strong></span>
		@endImpersonating
		<form action="{{ route('impersonate-ui.take') }}" method="POST" class="form">
			@csrf
			<div class="form-group mb-1 mt-2">

			    <label for="impersonate_id"><strong>Impersonate:</strong></label>
				<select name="impersonate_id" id="impersonate_id" class="custom-select" {!! !config('laravel-impersonate-ui.show_button') ? ' onchange="javascript:this.form.submit()"' : '' !!}>
					@foreach($users as $user)
						@canBeImpersonated($user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
						@else
							<option value="{{ $user->id }}" selected disabled>{{ $user->name }}</option>
						@endCanBeImpersonated
					@endforeach
				</select>
			</div>
			<div class="d-flex justify-content-between mt-3">
				@if(config('laravel-impersonate-ui.show_button'))
					<input type="submit" value="Impersonate" class="btn btn-primary">
				@endif

				@impersonating
					<a href="{{ route('impersonate-ui.leave') }}" class="btn btn-warning">Leave</a>
				@endImpersonating
			</div>
				
		</form>
		<span id="impersonate-ui-close" onclick="toggleFull()"><strong> X </strong></span>

	</div>
</div>

<style type="text/css">
	#impersonate-ui{
		position: fixed;
		z-index: 99;
		bottom: 10px;
		right: 10px;
		padding: 14px;
		border-radius: 100%;
		background-color: #ff793f;
		text-align: center;
		box-shadow: 0px 10px 1px #ddd, 0 10px 20px #ccc;
	  	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	  	transition: all 0.3s cubic-bezier(.25,.8,.25,1);
	}
	#impersonate-ui.position-top-left,
	#impersonate-ui.position-bottom-left{
		right: auto;
		left: 10px;
	}
	#impersonate-ui.position-top-left,
	#impersonate-ui.position-top-right{
		top: 10px;
		bottom: auto;
	}
	#impersonate-ui:hover {
	  box-shadow: 0 14px 28px rgba(0,0,0,0.15), 0 10px 10px rgba(0,0,0,0.22);
	}
	#impersonate-ui-icon{
		position: relative;
		display: inline-block;
		width:30px;
		height:30px;
		cursor: pointer;
	}
	#impersonate-ui-fullcontainer.show{
		transform: scaleY(1);    
	}
	#impersonate-ui-fullcontainer{
		transform: scaleY(0);    
	    transform-origin: bottom;
	    transition: transform 100ms ease;
		position: absolute;
		bottom:20px;
		right:20px;
		min-width: 400px;
		background-color: #f7f1e3;
		border-color: #333;	
		padding: 40px 60px;
		border-radius: 7px;
	 	box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
		text-align: left;	
		color: #333;	
	}

	#impersonate-ui.position-top-left #impersonate-ui-fullcontainer,
	#impersonate-ui.position-bottom-left #impersonate-ui-fullcontainer{
		left:10px;
		right:auto;
	}

	#impersonate-ui.position-top-right #impersonate-ui-fullcontainer,
	#impersonate-ui.position-top-left #impersonate-ui-fullcontainer{
	    transform-origin: top;
		top: 20px;
		bottom: auto;
	}

	#impersonate-ui-close{
		position: absolute;
		top: 16px;
		right: 26px;
		color: #bbb;
		cursor: pointer;
		font-size: 130%;
	}
</style>
<script type="text/javascript">
	function toggleFull(){
		var fullcontainer = document.querySelector('#impersonate-ui-fullcontainer');
		fullcontainer.classList.toggle('show');
	}
</script>
@endCanImpersonate