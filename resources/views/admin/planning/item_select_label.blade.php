@foreach ($item->getItemLabels as $label)
<li class="labels-block__list__item d-inline-flex">
    <span class="labels-block__list__item__element" style="color: #ffffff; background-color: {{ $label->getLabel->bg_color }}">
        {{ $label->getLabel->name }}
    </span>
</li> 
@endforeach 