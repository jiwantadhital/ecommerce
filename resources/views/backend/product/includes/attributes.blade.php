<div class="table-responsive">
  <table class="table table-striped table-bordered" id="attribute_wrapper">
    <tr>
      <th>Name</th>
      <th>Value</th>
      <th>Action</th>
    </tr>
    <tr>
      <td><select name="attribute_id[]" class="form-control">
          <option value="">Select Attribute</option>
          @foreach($data['attributes'] as $attribute)
            <option value="{{$attribute->id}}">{{$attribute->name}}</option>
          @endforeach
        </select></td>
      <td><input type="text" name="attribute_value[]" placeholder="Enter Attribute Value" class="form-control"/></td>
      <td>
        <a class="btn btn-block btn-warning sa-warning remove_row"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
  </table>
  <button type="button"  class="btn btn-info" id="addMoreAttribute" style="margin-bottom: 20px"><i class="fa fa-plus"></i> Add</button>
</div>
