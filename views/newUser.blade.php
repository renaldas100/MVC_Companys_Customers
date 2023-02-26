

@extends("layouts.main")
@section("content")


        <div class="col-md-12 my-5">
            <div class="card">
                <div class="card-header">Naujos paskyros sukūrimas</div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Įveskite elektroninio pašto adresą</label>
                            <input class="form-control" type="text" name="email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Įveskite slaptažodį</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pakartokite slaptažodį</label>
                            <input class="form-control" type="password" name="password2">
                        </div>

                        <button type="submit" class="btn btn-success" name="saveNewUser">Sukurti paskyrą</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
