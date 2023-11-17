select2Function();
function select2Function() {
    $(".select-nomfamille").select2({
        tags: true,
        tokenSeparators: [',', ' '],
        placeholder: 'Sélectionnez ou entrez un nom ',
        allowClear: true,
        containerCssClass: 'select2-container--custom-height',
    }).on('change', function (e) {
        let label = $(this).find("[data-select2-tag=true]");
        //on vérifie si le label n'est pas déjà à l'intérieur de notre select
        if (label.length && $.inArray(label.val(), $(this).val() !== -1)) {
            //on ajoute le label à notre base de donnée
            $.ajax({
                url: "/noms/ajout/ajax/" + encodeURIComponent(label.val()),
                type: "POST",
            }).done(function (data) {
                //pour l'ajout en ajax on crée un controlleur
                label.replaceWith(`<option selected value="${data.id}">${label.val()}</option>`);
            })

        }
    });
}
