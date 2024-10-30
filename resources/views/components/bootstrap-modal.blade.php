@props([
    'modalId' => 'newModal',
    'modalSize' => 'lg',
    'modalHeaderBgColorClass' => 'bg-info',
    'modalTitleId' => 'modalTitle',
    'title' => '',
    'formId' => 'modalForm',
    'action' => '#',
    'method' => 'POST',
    'isPatchMethod' => false,
    'cancelButtonText' => 'Close',
    'submitButtonClass' => 'btn-primary',
    'submitButtonText' => 'Save'
])

<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalTitleId }}" aria-hidden="true">
    <div class="modal-dialog modal-{{ $modalSize }} modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header {{ $modalHeaderBgColorClass }}">
                <h5 class="modal-title" id="{{ $modalTitleId }}">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="{{ $formId }}" action="{{ $action }}" method="{{ $method }}" enctype="multipart/form-data">
                @csrf
                @if($isPatchMethod)
                    @method('PATCH')
                @endif

                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $cancelButtonText }}</button>
                    <button type="submit" class="btn {{ $submitButtonClass }}">{{ $submitButtonText }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
