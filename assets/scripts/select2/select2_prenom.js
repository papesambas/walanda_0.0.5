select2Function();
function select2Function() {
    $(".select-prenom").select2({
        tags: true,
        tokenSeparators: [',', '  '],
        placeholder: 'Sélectionnez ou entrez un prénom ',
        allowClear: true,
    }).on('change', function (e) {
        let label = $(this).find("[data-select2-tag=true]");
        //on vérifie si le label n'est pas déjà à l'intérieur de notre select
        if (label.length && $.inArray(label.val(), $(this).val() !== -1)) {
            //on ajoute le label à notre base de donnée
            $.ajax({
                url: "/prenoms/ajout/ajax/" + label.val(),
                type: "POST",
            }).done(function (data) {
                //pour l'ajout en ajax on crée un controlleur
                label.replaceWith(`<option selected value="${data.id}">${label.val()}</option>`);
            })
        }
    });
}
