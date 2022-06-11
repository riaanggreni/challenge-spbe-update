<div class="form-group row">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Sub Permission</label>
    <div class="col-sm-12 col-md-6">
        <select name="is_parent" class="form-control" id="is_parent">
			<option value="y">Ya</option>
			<option value="n">Tidak</option>
		</select>
        {!! $errors->first('is_parent', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Parent</label>
    <div class="col-sm-12 col-md-6">
        <select name="parent_id" class="form-control" id="parent_id"></select>
        {!! $errors->first('parent_id', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Permission</label>
    <div class="col-sm-12 col-md-6">
        <input type="text" name="name" id="name" class="form-control">
        {!! $errors->first('name', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Display</label>
    <div class="col-sm-12 col-md-6">
        <input type="text" name="display_name" id="display_name" class="form-control">
        {!! $errors->first('display_name', '<p class="text-danger">:message</p>') !!}
    </div>
</div>

<div class="form-group row">
    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
    <div class="col-sm-12 col-md-7">
        {!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
    </div>
</div>