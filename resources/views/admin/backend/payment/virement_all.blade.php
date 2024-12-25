@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3"> 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Tous les Paiements par virement</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Search Form -->
    <form class="mb-4">
        <div class="input-group">
            <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par nom, email ou formation" style="max-width: 400px;">
            <button class="btn btn-primary px-5" type="button">Rechercher</button>
        </div>
    </form>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="paymentTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nom de l'utilisateur</th>
                            <th>Email</th>
                            <th>Id commande</th>
                            <th>statut</th>
                            <th>Date</th>
                            <th>Formation</th>
                            <th>Reçu</th>
                            
                            <th>Action</th>
                            

                           

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="user-name">{{ $item->name }}</td>
                            <td class="user-email">{{ $item->email }}</td>
                            <td>{{ $item->invoice_no }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->order_date }}</td>
                            <td class="course-title">{{ $item->course ? $item->course->course_title : 'Aucune formation' }}</td>
                            <td>
                                <a href="{{ route('admin.download.receipt', $item->id) }}" class="btn btn-primary">Télécharger le reçu</a>
                            </td>



                            <td>
    @if ($item->is_validated)
        <span class="text-success"><strong>Virement valide</strong></span>
    @elseif ($item->is_invalidated) <!-- Ajouter cette condition -->
        <span class="text-danger"><strong>Virement invalide</strong></span>
    @else
        <form action="/test-email" method="POST" onsubmit="this.querySelector('button[type=submit]').disabled = true;" style="display:inline;">
            @csrf
            <input type="hidden" name="payment_id" value="{{ $item->id }}">
            <button type="submit" class="btn btn-success px-5">Valider</button>
        </form>
        
        <form action="{{ route('admin.invalidate.virement', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir invalider ce virement ?');">
            @csrf
            <button type="submit" class="btn btn-danger px-5">Invalider</button>
        </form>
    @endif

</td>





     


                            



                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to filter by name, email, or course title -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input = this.value.toLowerCase();
        var rows = document.querySelectorAll('#paymentTable tbody tr');

        rows.forEach(function(row) {
            var name = row.querySelector('.user-name').textContent.toLowerCase();
            var email = row.querySelector('.user-email').textContent.toLowerCase();
            var courseTitle = row.querySelector('.course-title').textContent.toLowerCase(); // Récupère le titre du cours

            if (name.includes(input) || email.includes(input) || courseTitle.includes(input)) { // Ajoute le titre du cours à la condition
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>

@endsection