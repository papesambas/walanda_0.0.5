select2Function();

function select2Function() {
    $(function () {
        $(".select-Meretelephone").select2({
            tags: true,
            tokenSeparators: [',', '  '],
            placeholder: 'Entrez un # de téléphone ',
            allowClear: true,
        }).on('change', function (e) {
            console.log("Change event triggered");
            let label = $(this).find("[data-select2-tag=true]");
            let telephoneId = $(this).val();
            if (label.length == 1) {
                console.log("Label length is 1"); // Message de débogage
                labelVal = label.val();
                if (labelVal) {
                    let labelLength = labelVal.length;
                    if (labelLength == 12 && $.inArray(label.val(), $(this).val() !== -1)) {
                        $.ajax({
                            url: "/telephones/ajout/ajax/" + label.val(),
                            type: "POST",
                        }).done(function (data) {
                            console.log("Data from /telephones/ajout/ajax/: ", data); // Afficher les données récupérées
                            label.replaceWith(`<option selected value="${data.id}">${label.val()}</option>`);
                            //$('#parents_recherche_mere_telephone').empty().append($('<option></option>').attr('value', data.id).text(label.val()));
                            $.ajax({
                                url: "/meres/telephones/search/ajax/" + telephoneId,
                                type: "POST",
                            }).done(function (data) {
                                if (data.error) {
                                    alert(data.error);
                                    $('#parents_recherche_mere_nom').select2('val', null);
                                    $('#parents_recherche_mere_prenom').select2('val', null);
                                    $('#parents_recherche_mere_profession').select2('val', null);
                                    $('#parents_recherche_SearchMere').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                                    $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                                    $('#parents_recherche_mere_telephone2').select2('val', null);
                                } else {
                                    if (data.mereId !== null) {
                                        $('#parents_recherche_mere_nom').empty().append($('<option></option>').attr('value', data.nomId).text(data.nom));
                                        $('#parents_recherche_mere_prenom').empty().append($('<option></option>').attr('value', data.prenomId).text(data.prenom));
                                        $('#parents_recherche_mere_profession').empty().append($('<option></option>').attr('value', data.professionId).text(data.profession));
                                        $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                                        $('#parents_recherche_mere_telephone2').empty().append($('<option></option>').attr('value', data.telephone2Id).text(data.telephone2));
                                    } else {
                                        // Récupérer le numéro dans le champ #parents_recherche_mere_telephone
                                        $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                                        // Assurez-vous que le numéro est également défini dans le champ #parents_mere_numero si nécessaire
                                        $('#parents_recherche_mere_numero').val(data.telephone);
                                    }
                                }
                            })
                        })
                    } else {
                        alert("Le numéro de téléphone du père doit avoir au moins 12 caractères.");
                    }
                }
            }

            if (label.length == 0 && $.inArray(label.val(), $(this).val() !== -1)) {
                console.log("Label length is 0");
                $.ajax({
                    url: "/meres/telephones/search/ajax/" + telephoneId,
                    type: "POST",
                }).done(function (data) {
                    console.log("Data from /meres/telephones/search/ajax/: ", data); // Afficher les données récupérées
                    if (data.error) {
                        alert(data.error);
                        $('#parents_recherche_mere_nom').select2('val', null);
                        $('#parents_recherche_mere_prenom').select2('val', null);
                        $('#parents_recherche_mere_profession').select2('val', null);
                        $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                        $('#parents_recherche_mere_telephone2').select2('val', null);
                    } else {
                        if (data.mereId !== null) {
                            $('#parents_recherche_mere_nom').empty().append($('<option></option>').attr('value', data.nomId).text(data.nom));
                            $('#parents_recherche_mere_prenom').empty().append($('<option></option>').attr('value', data.prenomId).text(data.prenom));
                            $('#parents_recherche_mere_profession').empty().append($('<option></option>').attr('value', data.professionId).text(data.profession));
                            $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                            $('#parents_recherche_mere_telephone2').empty().append($('<option></option>').attr('value', data.telephone2Id).text(data.telephone2));
                        } else {
                            // Récupérer le numéro dans le champ #parents_recherche_mere_telephone
                            $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                            // Assurez-vous que le numéro est également défini dans le champ #parents_recherche_mere_numero si nécessaire
                            $('#parents_recherche_mere_numero').val(data.telephone);
                        }
                    }
                    if (data.errorTel) {
                        /*setTimeout(function () {
                            location.reload();
                        }, 200);*/
                        alert(data.errorTel);
                        $('#parents_recherche_SearchMere').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.nomId).text(data.nom));
                        $('#parents_recherche_mere_nom').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.nomId).text(data.nom));
                        $('#parents_recherche_mere_prenom').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.prenomId).text(data.prenom));
                        $('#parents_recherche_mere_profession').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.professionId).text(data.profession));
                        $('#parents_recherche_mere_telephone1').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.professionId).text(data.telephone1));
                        $('#parents_recherche_mere_telephone2').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.ninaId).text(data.telephone2));

                    }
                    if (data.errorTele) {
                        alert(data.errorTele);
                        $('#parents_recherche_mere_nom').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.nomId).text(data.nom));
                        $('#parents_recherche_mere_prenom').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.prenomId).text(data.prenom));
                        $('#parents_recherche_mere_profession').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.professionId).text(data.profession));
                        $('#parents_recherche_mere_telephone1').empty().append($('<option></option>').attr('value', data.telephoneId).text(data.telephone));
                        $('#parents_recherche_mere_telephone2').select2('destroy').val("").select2();//.empty().append($('<option></option>').attr('value', data.ninaId).text(data.nina));

                    }

                })
            }
        });
        // Réinitialiser les champs Select2 lorsque la valeur de #parents_recherche_mere_telephone change
        $('#parents_recherche_SearchMere').on('change', function () {
            setTimeout(function () {
                $('#parents_recherche_mere_nom').select2('val', null);
                $('#parents_recherche_mere_prenom').select2('val', null);
                $('#parents_recherche_mere_profession').select2('val', null);
                $('#parents_recherche_mere_telephone1').select2('val', null);
                $('#parents_recherche_mere_telephone2').select2('val', null);
            }, 100); // Délay en millisecondes
        });
    });
}
