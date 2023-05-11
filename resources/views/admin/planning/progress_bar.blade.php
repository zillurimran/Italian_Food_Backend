@if ($checklist->getItems->count() > 0)
    <div class="checklist-block__left flex-shrink-0 mr-1">
        <h5 class="checklist-block__progress__counter mb-0"><span class="checklist-block__progress__number">{{ floor($checklist->getItems->where('status', 1)->count()/$checklist->getItems->count() * 100) }}</span>%</h5>
    </div>
    <div class="checklist-block__right flex-grow-1">
        <div class="checklist-block__progress__bar position-relative rounded-pill overflow-hidden">
            <span class="checklist-block__progress__bar__progress position-absolute" style="width: {{ floor($checklist->getItems->where('status', 1)->count()/$checklist->getItems->count() * 100) }}%"></span>
        </div>
    </div>
@else
    <div class="checklist-block__left flex-shrink-0 mr-1">
        <h5 class="checklist-block__progress__counter mb-0"><span class="checklist-block__progress__number">0</span>%</h5>
    </div>
    <div class="checklist-block__right flex-grow-1">
        <div class="checklist-block__progress__bar position-relative rounded-pill overflow-hidden">
            <span class="checklist-block__progress__bar__progress position-absolute"></span>
        </div>
    </div>
@endif