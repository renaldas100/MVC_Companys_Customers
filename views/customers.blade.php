
@extends("layouts.main")
@section("content")

    <a class="btn btn-success text-decoration-none my-3" href="index.php?logout=true">Atsijungti</a>
    <div class="card">
    <div class="card-header">Vartotojai</div>

    <div class="card-body">
        <a href="index.php" class="btn btn-success">Atgal į pradinį puslapį</a>
        <a href="newCustomer.php?id={{ $id }}" class="btn btn-success float-end">Pridėti naują vartotoją</a>
        <table class="table">
            <thead>
            <tr>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Telefonas</th>
                <th>El.paštas</th>
                <th>Adresas</th>
                <th>Pareigos</th>
                <th>Registruota pokalbių</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach( \models\Customer::getCustomersByCompanyID($id) as $customer)
            <tr>
                <td>{{ $customer->getName() }}</td>
                <td>{{ $customer->getSurname() }}</td>
                <td>{{ $customer->getPhone() }}</td>
                <td>{{ $customer->getEmail() }}</td>
                <td>{{ $customer->getAddress() }}</td>
                <td>{{ $customer->getPosition() }}</td>
                <td class="text-center">{{ \models\Conversation::countConversations($customer->getId()) }}</td>
                <td>
                    <a class="btn btn-info" href="conversations.php?id={{ $customer->getId() }}">Rodyti pokalbius</a>
                </td>
                <td>
                    <a class="btn btn-info" href="updateCustomer.php?id={{ $customer->getId() }}">Redaguoti</a>
                </td>
                <td>
                    <a class="btn btn-danger"
                       href="customers.php?delete={{ $customer->getId() }}">Trinti</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection