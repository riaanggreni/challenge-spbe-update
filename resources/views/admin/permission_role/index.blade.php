{{-- @extends('layouts.backend') --}}

@extends('noble.master')

@section('content-header')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
	<div>
		<h4 class="mb-3 mb-md-0">Manajemen Permission Role</h4>
	</div>
	<div class="d-flex align-items-center flex-wrap text-nowrap">
		<nav class="page-breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Manajemen Permission Role</li>
			</ol>
		</nav>
	</div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
	<div class="alert alert-primary d-none" id="alert_permission"></div>
      <div class="card">
        <div class="card-body">
			<div style="padding-bottom: 20px;">
				<label for="role">Role</label>
				<select class="form-control" name="" id="role">
					<option></option>
					@foreach (session('authUserData')->broker_roles as $value)
					<option value="{{ $value->id }}" {{ ($role_id == $value->id) ? 'selected' : '' }}>{{ $value->name }}</option>
					@endforeach
				</select>
			</div>

			<div><strong>Permission</strong></div><hr>
			<div id="list_permission">
				<?php
					echo (new App\Services\Auth\PermissionService)->show_permission($role_id);	
				?>
			</div><hr>

			<div>
				<button type="button" id="save_permission" class="btn btn-primary btn-md">Simpan</button>
			</div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('vendor/jstree/dist/themes/default/style.min.css') }}" />
@endsection

@section('js')
<script src="{{ asset('vendor/jstree/dist/jstree.min.js') }}"></script>

<script>
	$('#list_permission').jstree({
        "checkbox" : {
            "keep_selected_style" : false
        },
        "plugins" : [ "checkbox" ],
        "core":{
            "themes": {
                "icons": false
            }
        }
	});
	
	$(document).ready(function () {
		$('#role').select2({
			'placeholder': 'Pilih Role',
		});

		$('#role').change(function (e) { 
			e.preventDefault();

			var url = '{{ route('permission_role.index') }}?role_id=' + $('#role').val();
			
			window.location.replace(url);
		});

		$('#save_permission').click(function (e) { 
			e.preventDefault();
			
			var permission_id = [];
        
			$.each($("#list_permission").jstree("get_checked",true),function(){
				if(this.parent != '#'){
					permission_id.push(this.parent);
				}

				permission_id.push(this.id);
			});

			$.ajax({
				type: "POST",
				url: "{{ route('permission_role.store') }}",
				data: {
					role_id: $('#role').val(),
					permission_id: permission_id,
				},
				success: function (response) {
					console.log(response);
					$('#alert_permission').removeClass('d-none');
					$('#alert_permission').html(response);
				}
			});
		});
	});
</script>
@endsection