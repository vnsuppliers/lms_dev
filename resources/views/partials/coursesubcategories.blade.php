@if(isset($parent_id))
    @php
        $children = $coursesubcategories->where('parent_id', $parent_id);
    @endphp

    @if($children->isNotEmpty())
        <ul class="list-unstyled pl-4">
            @foreach($children as $subcategory)
                <li>
                    <input class="cat-radio-btn" type="radio" name="category_id" id="parent_id_{{ $subcategory->id }}" value="{{ $subcategory->id }}" @if((isset($courses_id) && $subcategory->id == $courses_id->category_id) || request()->input('add_category_id') == $subcategory->id || request()->input('category_id') == $subcategory->id || request()->input('parent_id') == $subcategory->id) checked @endif                                 
                     @if(request()->input('add_category_id') && request()->input('add_category_id') != $subcategory->id) disabled @endif>
                    <label class="cat-tree-label" for="parent_id_{{ $subcategory->id }}">{{ $subcategory->category_name }}</label>
                    @include('partials.coursesubcategories', ['coursesubcategories' => $coursesubcategories, 'parent_id' => $subcategory->id])
                </li>
            @endforeach
        </ul>
    @endif
@endif




