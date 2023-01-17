<?php 
  $categories = json_decode(Auth::user()->category_id);
  $array = array_diff($categories,Acelle\Jobs\HelperJob::categories_select());
  $selectcat = array_values($array);
?>
<div class="form-group" style="display: grid;">
    <label class="form-label" for="phone-no">Business Sub Category</label>
     <select id="example-getting-started" class="form-control" name="category_id[]" multiple="multiple">
         @foreach($subcategories as $key => $category)
          <option value="{{$category->id}}" @foreach($selectcat as $cat) {{$category->id == $cat ? 'selected':''}} @endforeach>{{$category->category_name}}</option>
         @endforeach
     </select>
  </div>