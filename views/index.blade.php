
@extends("layouts.main")
@section("content")

    <a class="btn btn-success text-decoration-none my-3" href="index.php?logout=true">Atsijungti</a>
            <div class="card">
                <div class="card-header">Įmonės</div>

                <div class="card-body">
                    <a href="newCompany.php" class="btn btn-success float-end">Pridėti naują įmonę</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Pavadinimas</th>
                            <th>Adresas</th>
                            <th>PVM kodas</th>
                            <th>Tel.numeris</th>
                            <th>El.paštas</th>
                            <th>Registruota vartotojų</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( \models\Company::all() as $company)
                        <tr>
                            <td>{{ $company->getName() }}</td>
                            <td><{{ $company->getAddress() }}</td>
                            <td>{{ $company->getVatCode() }}</td>
                            <td>{{ $company->getPhone() }}</td>
                            <td>{{ $company->getEmail() }}</td>
                            <td class="text-center">{{  \models\Customer::countCustomers($company->getId()) }}</td>
                            <td>
                                <a class="btn btn-info" href="customers.php?id={{ $company->getId() }}">Rodyti vartotojus</a>
                            </td>
                            <td>
                                <a class="btn btn-info" href="updateCompany.php?id={{ $company->getId() }}">Redaguoti</a>
                            </td>
                            <td>
                                <a class="btn btn-danger"
                                   href="index.php?delete={{ $company->getId() }}">Trinti</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection