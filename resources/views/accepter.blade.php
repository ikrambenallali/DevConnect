<x-app-layout>
<div class="container">
    <h2 class="font-semibold mb-4 flex justify-center">Demandes de connexion</h2>
    <ul class="list-group">
    @foreach($demandes as $demande)
    <li class="list-group-item d-flex justify-content-between align-items-center" id="demande-{{ $demande->id }}">
        <span>{{ $demande->user->name }}</span>
        <button class="btn btn-success bg-blue-700 text-white p-2 rounded-md" onclick="acceptConnection({{ $demande->id }})">Accepter</button>
        <button class="btn btn-success bg-blue-700 text-white p-2 rounded-md" onclick="rejectConnection({{ $demande->id }})">Refuser</button>

    </li>
@endforeach


    </ul>
</div>

<script>
    function acceptConnection(connectionId) {
        fetch(`/accepterConnection/${connectionId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Connection accepted') {
                document.getElementById(`demande-${connectionId}`).remove();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
    // Reject Connection
function rejectConnection(connectionId) {
    fetch(`/refuserConnection/${connectionId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Connection rejected') {
                removeElementWithHr(`request-${connectionId}`);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}
</script>
</x-app-layout>
