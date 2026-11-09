@if(isset($parent_id))
    @php
        $children = $coursesubcategories->where('parent_id', $parent_id);
    @endphp

    @if($children->isNotEmpty())
        <ul class="list-unstyled pl-3">
            @foreach($children as $subcategory)
                <li>
                    @if(isset($courses_data) && $subcategory->id == $courses_data->course_details->category_id) <input type="checkbox" checked>  @endif
                    <label for="parent_id_{{ $subcategory->id }}">{{ $subcategory->category_name }}</label>
                    @include('partials.usersubcategory', ['coursesubcategories' => $coursesubcategories, 'parent_id' => $subcategory->id])
                </li>
            @endforeach
        </ul>
    @endif
@endif




