@forelse ($tenders as $tender)
    <tr>
        <td class="text-center">{{ $tender->tender_no }}</td>
        <td class="text-start">{{ $tender->description }}</td>
        <td>
            @foreach ($tender->tenderFiles as $tenderFile)
                <p>
                    <a href="{{ url($tenderFile->downloadLink) }}" target="_blank">
                        <i class="fas fa-file-download" aria-hidden="true"></i>
                        {{ $tenderFile->name }}
                    </a>
                </p>
            @endforeach
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3">No tenders found for the selected financial year.</td>
    </tr>
@endforelse