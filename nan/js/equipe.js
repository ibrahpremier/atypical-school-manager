
function infoEquipe(){

        $.ajax({
                url: '../nan/php/equipe.php?loadequipe',
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){

        res='';
        for(i=0; i<param.length; i++){

        res+= `
        <div class="card col-md-4 ml-3">
           <div class="card-body">
              <div class="h4 text-muted text-left mb-4">
                <i class="fa fa-users"></i>&nbsp;`;

        res+= param[i].nom_equipe;
        
        res+=`
                <div class="float-right">
                <a class="btn bg-transparent" href="mailto:`+param[i].email+`" title="Envoyer mail">
                <i class="fa fa-envelope"></i>
                </a>
                <a class="btn bg-transparent" href="#" title="Modifier" data-toggle="modal" data-target="#modal_modifier_equipe" onclick="modal_mod_equipe(`+param[i].id_equipe+`)">
                <i class="fa fa-pencil"></i>
                </a>
                <a href="" title="Supprimer" class=" btn bg-transparent" data-toggle="modal" data-target="#modal_supprimer_equipe"  onclick="modal_supp_equipe(`+param[i].id_equipe+`)">
                <i class="fa fa-trash" ></i>
                </a>
                </div>
           </div>
                <div class=" mb-0">
                        <span class="h4 count">`;

        res+= param[i].nbr_membre;

        res+=`
                        </span>
                        <small class="text-muted text-uppercase font-weight-bold"> Membres</small>
                </div>
                <div class="progress progress-xs mt-3 mb-0 bg-flat-color-5" style="width: 50%; height: 5px;">
                </div>
                <br>
                <div>
                        <a href="presence.php?eq=`+param[i].id_equipe+`" class="btn btn-outline-success btn-sm text-dark ">Faire l'appel</a><br><br>
                        <a href="liste_etudiants.php?eq=`+param[i].id_equipe+`" class="btn btn-outline-success btn-lg btn-block text-dark">Gérer membres</a>
                </div>
           </div>
        </div>`;

                        }
                        $('#contentEquipe').html(res);
                    }
            });

}



function add_equipe(){
        
        if($('#txt_equipe').val()==''){
                ShowMessage('alert_equipe',0,'Veuillez remplir le champ')
        }
        else{

                $.ajax({
                        url: '../nan/php/equipe.php?add_eq',
                        type: 'post',
                        data: new FormData($(frm_eq)[0]),
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                            spinner('spinner_equipe');
                            ShowMessage('alert_equipe',param.code,param.message);
                            reinit('frm_eq'); 
                            infoEquipe();
                    }
            });
        }
}



function modal_mod_equipe(id_equipe){

        $.ajax({
                url: '../nan/php/equipe.php?info_modal_mod_eq='+id_equipe,
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        $("#txt_mod_equipe").val(param.nom_equipe);
                        $("#btn_maj_eq").attr('onclick','maj_equipe('+id_equipe+')');
                }
        });
}


function maj_equipe(id_equipe){
        
        if($('#txt_mod_equipe').val()==''){
                ShowMessage('alert_equipe',0,'le champ ne peut etre vide')
        }
        else{

                $.ajax({
                url: '../nan/php/equipe.php?maj_eq='+id_equipe,
                type: 'post',
                data: new FormData($(frm_eq_m)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner_equipe');
                        ShowMessage('alert_equipe',param.code,param.message);
                        infoEquipe();
                }
            });
        }
}


function modal_supp_equipe(id_equipe){

        $.ajax({
                url: '../nan/php/equipe.php?info_modal_supp_eq='+id_equipe,
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){

                        $("#titre_modal_supp").html('Supprimer '+param.nom_equipe);
                        $("#btn_supp_eq").attr('onclick','supp_equipe('+id_equipe+')');
                }
        });
}


function supp_equipe(id_equipe){

        $.ajax({
                url: '../nan/php/equipe.php?supp_eq='+id_equipe,
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner_equipe');
                        ShowMessage('alert_equipe',param.code,param.message);
                        infoEquipe();
                }
        });
}
