<div class="form-group">
  {!! Form::label('category_id', 'Category'); !!}
  {!! Form::select('category_id', $data['categories'], null,['class' => 'form-control','placeholder' => 'Select category']) !!}
  @error('category_id')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('subcategory_id', 'Subcategory'); !!}
  {!! Form::select('subcategory_id', $data['subcategories'], null,['class' => 'form-control','placeholder' => 'Select subcategory']) !!}
  @error('subcategories')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('title','Title',['class' => 'control-label']) !!}
  {!! Form::text('title',null,['class' => 'form-control']) !!}
  @error('title')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('slug','Slug',['class' => 'control-label']) !!}
  {!! Form::text('slug',null,['class' => 'form-control']) !!}
  @error('slug')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('price','Price',['class' => 'control-label']) !!}
  {!! Form::number('price',null,['class' => 'form-control']) !!}
  @error('price')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('discount','Discount',['class' => 'control-label']) !!}
  {!! Form::number('discount',null,['class' => 'form-control']) !!}
  @error('discount')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('quantity','Quantity',['class' => 'control-label']) !!}
  {!! Form::number('quantity',null,['class' => 'form-control']) !!}
  @error('quantity')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('unit_id', 'Unit'); !!}
  {!! Form::select('unit_id', $data['units'], null,['class' => 'form-control','placeholder' => 'Select Unit']) !!}
  @error('unit_id')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('short_description','Short Description',['class' => 'control-label']) !!}
  {!! Form::textarea('short_description',null,['class' => 'form-control','rows' => 3]) !!}
  @error('short_description')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('description','Description',['class' => 'control-label']) !!}
  {!! Form::textarea('description',null,['class' => 'form-control','rows' => 3]) !!}
  @error('description')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('specification','Specification',['class' => 'control-label']) !!}
  {!! Form::textarea('specification',null,['class' => 'form-control','rows' => 3]) !!}
  @error('specification')
  <span class="text text-danger">{{$message}}</span>
  @enderror
</div>
<div class="form-group">
  {!! Form::label('feature_product','Feature product',['class' => 'control-label']) !!}
  {!! Form::radio('feature_product',1) !!}Active
  {!! Form::radio('feature_product',0,true) !!}De-Active
</div>
<div class="form-group">
  {!! Form::label('flash_product','Flash product',['class' => 'control-label']) !!}
  {!! Form::radio('flash_product',1) !!}Active
  {!! Form::radio('flash_product',0,true) !!}De-Active
</div>
<div class="form-group">
  {!! Form::label('status','Status',['class' => 'control-label']) !!}
  {!! Form::radio('status',1) !!}Active
  {!! Form::radio('status',0,true) !!}De-Active
</div>
