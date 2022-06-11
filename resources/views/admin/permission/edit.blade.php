{{-- @extends('layouts.backend') --}}
@extends('noble.master')

@section('content-header')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
	<div>
		<h4 class="mb-3 mb-md-0">Edit Permission</h4>
	</div>
	<div class="d-flex align-items-center flex-wrap text-nowrap">
		<nav class="page-breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Manajemen Permission</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit Permission</li>
			</ol>
		</nav>
	</div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
			{!! Form::open(['url' => route('permission.update', $permission->id), 'method' => 'put', 'class'=>'form-group', 'files'=>false]) !!}
              @include('admin.permission._form_edit')
            {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
@include('script.select2');

<script>
	$(document).ready(function () {
		var permission = {!! $permission !!};

		setSelect2('#parent_id', '{{ route('permission.select') }}', 'Pilih permission', _data = function (params) {
				return {
					input: $.trim(params.term),
				};
			});

		setSelectedSelect2('#parent_id', permission.parent, 'id', 'display_name');
	});

</script>
@endsection