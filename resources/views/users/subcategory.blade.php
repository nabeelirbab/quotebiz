 <div class="form-group control-text">
    <label>
        <b>Sub Category</b> (optional)
     </label>
     <select id="example-getting-started" class="form-control" name="category_id[]" multiple="multiple">
         @foreach($subcategories as $category)
         <option value="{{$category->id}}">{{$category->category_name}}</option>
         @endforeach
     </select>
  </div>