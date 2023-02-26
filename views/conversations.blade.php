
@extends("layouts.main")
@section("content")

    <a class="btn btn-success text-decoration-none my-3" href="index.php?logout=true">Atsijungti</a>
<div class="card">
    <div class="card-header">Pokalbiai</div>

    <div class="card-body">
        <a href="index.php" class="btn btn-success">Atgal į pradinį puslapį</a>
        <a href="newConversation.php?id={{ $id }}" class="btn btn-success float-end">Pridėti naują pokalbį</a>
        <table class="table">
            <thead>
            <tr>
                <th>Data</th>
                <th>Pokalbis</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach( \models\Conversation::getConversationsByCustomerID($id) as $conversation)
            <tr>
                <td>{{ $conversation->getDate() }}</td>
                <td>{{ $conversation->getConversation() }}</td>
                <td>
                    <a class="btn btn-info" href="updateConversation.php?id={{ $conversation->getId() }}">Redaguoti</a>
                </td>
                <td>
                    <a class="btn btn-danger"
                       href="conversations.php?delete={{ $conversation->getId() }}">Trinti</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection