select2Function();
function select2Function() {
    $(".select-telephone").select2({
        tags: true,
        tokenSeparators: [',', '  '],
        placeholder: 'Entrez un # de téléphone ',
        allowClear: true,
    }).on('change', function (e) {
        let label = $(this).find("[data-select2-tag=true]");

        // Vérifier si le label existe, s'il a au moins 12 caractères et si sa valeur n'est pas déjà présente dans les sélections actuelles du champ
        if (label.length && label.val().length >= 12 && $.inArray(label.val(), $(this).val() !== -1)) {
            // Effectuer la requête AJAX pour ajouter le nouveau numéro de téléphone à la base de données
            $.ajax({
                url: "/telephones/ajout/ajax/" + encodeURIComponent(label.val()),
                type: "POST",
            }).done(function (data) {
                // Pour l'ajout en AJAX, on crée un contrôleur
                label.replaceWith(`<option selected value="${data.id}">${label.val()}</option>`);
            })
        } else {
            // Afficher un message d'erreur si le numéro de téléphone ne satisfait pas la condition
            alert("Le numéro de téléphone autre doit avoir au moins 12 caractères. Ajouter l'indicatif au besoin '+xxx'");
        }
    });
}
