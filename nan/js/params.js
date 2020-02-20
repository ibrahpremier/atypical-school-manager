
$(document).ready(function(){

        aff_localisation();

});


function aff_localisation(){
        $('#table_lo').DataTable({
		lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
                oLanguage: { "sUrl": "../assets/json/datatable_fr.txt" },
                sAjaxSource: "../nan/php/params.php?aff_lo",
                destroy: true
        });
}



function add_localisation(){
        
        if($('#txt_localite').val()==''){
                ShowMessage('alert_localisation',0,'Veuillez remplir le champ')
        }
        else{

                $.ajax({
                        url: '../nan/php/params.php?add_lo',
                        type: 'post',
                        data: new FormData($(frm_lo)[0]),
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                            spinner('spinner_localisation');
                            ShowMessage('alert_localisation',param.code,param.message);
                            reinit('frm_lo');
                            aff_localisation();
                    }
            });
        }
}


function modal_mod_localisation(id_localisation){

        $.ajax({
                url: '../nan/php/params.php?info_modal_maj_localisation='+id_localisation,
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        $("#txt_mod_localisation").val(param.nom_localisation);
                        $("#btn_maj_localisation").attr('onclick','maj_localisation('+id_localisation+')');
                }
        });
}



function maj_localisation(id_localisation){
        
        if($('#txt_mod_localisation').val()==''){
                ShowMessage('alert_localisation',0,'le champ ne peut etre vide')
        }
        else{

                $.ajax({
                url: '../nan/php/params.php?maj_loca='+id_localisation,
                type: 'post',
                data: new FormData($(frm_lo_m)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner_localisation');
                        ShowMessage('alert_localisation',param.code,param.message);
                        aff_localisation();
                }
            });
        }
}


function modal_supp_localisation(id_localisation){

        $.ajax({
                url: '../nan/php/params.php?info_modal_supp_loca='+id_localisation,
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){

                        $("#titre_modal_supp").html('Supprimer '+param.nom_localite+' ?');
                        $("#btn_supp_localisation").attr('onclick','supp_localisation('+id_localisation+')');
                }
        });
}


function supp_localisation(id_localisation){

        $.ajax({
                url: '../nan/php/params.php?supp_loca='+id_localisation,
                type: 'post',
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner_localisation');
                        ShowMessage('alert_localisation',param.code,param.message);
                        aff_localisation();
                }
        });
}




 
