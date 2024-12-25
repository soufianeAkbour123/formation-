$(function(){
    $(document).on('click', '#delete', function(e){
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Êtes-vous sûr ?',
            text: "Supprimer ces données ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimez-le !',
            cancelButtonText: 'Annuler' 
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    'Supprimé !',
                    'Votre fichier a été supprimé',
                    'success' 
                );
            }
        });
    });
});
