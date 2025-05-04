try {
    var $validator = jQuery("#formAjout").validate({
        lang: 'fr',
        highlight: function (formElement, label) {
            jQuery(label).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (label, formElement) {
            jQuery(label).closest('.form-group').removeClass('has-error');
            $(label).remove();
        }
    });
} catch (e) {
    // console.log("Erreur", e);
}

/**
 * Creation ou modification
 * 
 * @param string url Lien
 * @param object $formObject
 * @param string formData données serializées à envoyer
 * @param object $ajoutLoader
 * @param object $table L'objet bootstrap-table
 * @param boolean ajout determine si c'est un ajout ou une modification
 * @returns null
 */
function editerAction(methode, url, $formObject, formData, $ajaxLoader, $table, ajout) {
    // Convertir les données du formulaire en un objet URLSearchParams
    const formDataObject = new URLSearchParams(formData);

    //Désactiver le formulaire avant l'envoi
    $formObject.attr("disabled", true);

    //On met la position a static si le formulaire n'est pas dans un modal
    var loaderPosition = 'absolute';
    if(!$ajaxLoader.hasClass('modal')){
        loaderPosition = 'static';
    }

    //Activer le loader
    $ajaxLoader.loadingModal({
        position: loaderPosition,
        text: "En cours...",
        color: '#fff',
        opacity: '0.7',
        backgroundColor: 'rgb(0,0,0)',
        animation: 'fadingCircle'
    });

    fetch(url, {
        method: methode,
        body: formDataObject,
        cache: "no-cache",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(response => {
        if (response.code === 1) {
            var formElement = document.querySelector("#" + $formObject.attr("id"));
            // Réinitialiser le formulaire
            formElement.reset();

            if (ajout) { // creation
                $table.bootstrapTable('refresh');
                if(formElement.hasAttribute('data-name')){
                    location.reload();
                }
            } else { // modification
                $table.bootstrapTable('updateByUniqueId', {
                    id: response.data.id,
                    row: response.data
                });
                $table.bootstrapTable('refresh');
                if(loaderPosition === 'static' || formElement.hasAttribute('data-name')){
                   location.reload();
                }else{
                    $ajaxLoader.modal("hide");
                }
            }

            $formObject.trigger('eventAjouter', [response.data]);
            
            $.gritter.add({
                // heading of the notification
                title: "E-Civil",
                // the text inside the notification
                text: response.msg,
                sticky: false,
                image: "../plugin/gritter/img/confirm.png",
            });
        }else{
            $.gritter.add({
                // heading of the notification
                title: "E-Civil",
                // the text inside the notification
                text: response.msg,
                sticky: false,
                image: "../plugin/gritter/img/canceled.png",
            });
        }
       
    })
    .catch(err => {
        $.gritter.add({
            // heading of the notification
            title: "E-Civil",
             // the text inside the notification
            text: err.msg,
            sticky: false, 
            image: "../plugin/gritter/img/canceled.png",
        });
        $formObject.removeAttr("disabled");
    })
    .finally(() => {
        $formObject.removeAttr("disabled");
        //destroy the loading modal
        $ajaxLoader.loadingModal('destroy');
    });
}

/**
 * Sppression de données
 * 
 * @param string url Lien
 * @param string formData données serializées à envoyer
 * @param object $ajoutLoader
 * @param object $table L'objet bootstrap-table
 */
function supprimerAction(url, formData, $ajaxLoader, $table) {
    // Convertir les données du formulaire en un objet URLSearchParams
    const formDataObject = new URLSearchParams(formData);
    
    //Activer le loader
    $ajaxLoader.loadingModal({
        position: 'absolute',
        text: "En cours...",
        color: '#fff',
        opacity: '0.7',
        backgroundColor: 'rgb(0,0,0)',
        animation: 'fadingCircle'
    });

    fetch(url, {
        method: "DELETE",
        body: formDataObject,
        cache: "no-cache",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        }
    })
    .then(response => response.json())
    .then(response => {
        if (response.code === 1) {
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [response.data.id]
            });
            $ajaxLoader.modal("hide");
            $table.bootstrapTable('refresh');

            $.gritter.add({
                // heading of the notification
                title: "E-Civil",
                // the text inside the notification
                text: response.msg,
                sticky: false,
                image: "../plugin/gritter/img/confirm.png",
            });
        }else{
            $.gritter.add({
                // heading of the notification
                title: "E-Civil",
                // the text inside the notification
                text: response.msg,
                sticky: false,
                image: "../plugin/gritter/img/canceled.png",
            });
        }
    })
    .catch(err => {
        $.gritter.add({
            // heading of the notification
            title: "E-Civil",
             // the text inside the notification
            text: err.msg,
            sticky: false, 
            image: "../plugin/gritter/img/canceled.png",
        });
        $ajaxLoader.loadingModal('destroy');
    })
    .finally(() => {
        //destroy the loading modal
        $ajaxLoader.loadingModal('destroy');
    });
}


//Fonction de formattage de date
function formatDate(date) {
    let d = new Date(date);
    let day = String(d.getUTCDate()).padStart(2, '0');
    let month = String(d.getUTCMonth() + 1).padStart(2, '0'); // Les mois commencent à 0
    let year = d.getUTCFullYear();

    return `${day}-${month}-${year}`;
}

function numStr(a, b) {
    a = '' + a;
    b = b || ' ';
    var c = '',
        d = 0;
    while (a.match(/^0[0-9]/)) {
      a = a.substr(1);
    }
    for (var i = a.length-1; i >= 0; i--) {
      c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
      d++;
    }
    return c;
}


