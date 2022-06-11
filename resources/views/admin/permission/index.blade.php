{{-- @extends('layouts.backend') --}}

@extends('noble.master')

@section('content-header')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
	<div>
		<h4 class="mb-3 mb-md-0">Manajemen Permission</h4>
	</div>
	<div class="d-flex align-items-center flex-wrap text-nowrap">
		<nav class="page-breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('/')}}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Manajemen Permission</li>
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
            <div class="button pb-3">
              <a class="btn btn-primary" href="{{route('permission.create')}}"><i class="fas fa-plus"></i> Tambah Permission</a>
            </div>
            <div class="table-responsive">
              {!! $html->table(['class'=>'table table-hover', 'style'=>'width:100%']) !!}
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
    {!! $html->scripts() !!}
    @include('components/_script_adjust-table')
@endsection