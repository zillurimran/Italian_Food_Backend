@foreach ($order->getItemLabels as $label)
    <li class="labels-list__item">
        <span class="label" style="background-color: {{ $label->getLabel->bg_color }}"></span>
    </li>
@endforeach