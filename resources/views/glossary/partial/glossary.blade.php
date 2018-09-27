@forelse($glossarys as $glossary)

    @php $viewName = 'index'; @endphp


    <div class="col-md-12 glossary_box">

        <div class="card">
            <div class="card-body">
                <p>{{ $glossary->name_kor }}

                    @if ($glossary->name_eng == '')

                    @else
                        ( {{ $glossary->name_eng }} )
                    @endif
                </p>
                <small class="text-muted">{{ $glossary->description }}</small>
            </div>
        </div>

    </div>

@empty

@endforelse