
                <div class="form-wrap" style="width: 300px;">
                <select class="form-select" data-search="off" @change="categoriesbyid($event)" data-placeholder="Bulk Action" style="opacity: 1">
                    <option value="0">Select Sub Category</option>
                    @foreach($subcategories as $category)
                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                    @endforeach
                </select>
                </div>