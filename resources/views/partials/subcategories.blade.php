@if(isset($parent_id))
    @php
        $children = $subcategories->where('parent_id', $parent_id);
    @endphp

    @if($children->isNotEmpty())
        <ul class="list-unstyled pl-3">
            @foreach($children as $subcategory)
                <li>
                    <input class="cat-radio-btn" type="radio" name="parent_id" id="parent_id_{{ $subcategory->id }}" value="{{ $subcategory->id }}" 
                        @if(isset($data_id) && $subcategory->id == $data_id->parent_id) checked @endif>
                    <label class="cat-tree-label" for="parent_id_{{ $subcategory->id }}">{{ $subcategory->category_name }}</label>
                    @include('partials.subcategories', ['subcategories' => $subcategories, 'parent_id' => $subcategory->id])
                </li>
            @endforeach
        </ul>
    @endif
@endif




