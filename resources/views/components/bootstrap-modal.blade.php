<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $modalSize ?? 'modal-lg' }}" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalTitle }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="{{ $formId }}" action="{{ $formAction }}" method="{{ $formMethod ?? 'POST' }}">
                @csrf
                @if(isset($formMethod) && in_array(strtoupper($formMethod), ['PUT', 'PATCH', 'DELETE']))
                    @method($formMethod)
                @endif
                <div class="modal-body">
                    @if($operationType !== 'delete')
                        <!-- Slot for dynamic form content -->
                        {{ $slot }}
                    @else
                        <p>{{ $deleteMessage ?? 'Are you sure you want to delete this item?' }}</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn {{ $operationType === 'delete' ? 'btn-danger' : 'btn-success' }}">
                        {{ $submitLabel ?? ($operationType === 'delete' ? 'Yes, Delete' : 'Save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>