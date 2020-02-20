           
  
  

$(document).ready(function(){
    
});
                    
  
  function liste_loca(){
    
            $.ajax({
                url: '../nan/php/etudiants.php?liste_loca',
                type: 'post',
                dataType:'json',
                success: function(param){
                    res='<select class="form-control" data-live-search="true" name="loca" id="loca"><option value="null" disabled selected> ---CHOISIR---</option>';
                for(i=0; i<param.length; i++){
                    res+='<option value="'+param[i].id+'" class="uppercase" data-tokens="'+param[i].nom+'">'+param[i].nom+'</option>';
                }
                res+='</select>';
                    $("#sel_loca").html(res);
                    console.log(res);
                    console.log("charger la liste localites");
                     }
                });
    
        }


function add_etudiant(){
    
    if(($('#nom').val()=='')&&($('#prenom').val()=='')){
            ShowMessage('alert',0,'Veuillez remplir le champ')
    }
    else{

            $.ajax({
                    url: '../nan/php/etudiants.php?add_et',
                    type: 'post',
                    data: new FormData($(frm_et)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner');
                        ShowMessage('alert',param.code,param.message);
                        reinit('frm_et'); 
                }
        });
    }
}



function modal_archiver_et(id_etudiant){
    
            $.ajax({
                    url: '../nan/php/etudiants.php?info_modal_arch_et='+id_etudiant,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
    
                            $("#titre_modal_arch").html(param.nom_etudiant+' ?');
                            $("#btn_arch_et").attr('onclick','archiver_et('+id_etudiant+')');
                    }
            });
    }
    
    
    function archiver_et(id_etudiant){
    
            $.ajax({
                    url: '../nan/php/etudiants.php?arch_et='+id_etudiant,
                    type: 'post',
                    data: new FormData($(frm_arch_et)[0]),
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                            spinner('spinner');
                            ShowMessage('alert',param.code,param.message);
                            // document.location.href="nouvellepage.php"
                           setTimeout("location.reload()",1500);
                    }
            });
    }
    
    function modal_restaurer_et(id_etudiant){
        
                $.ajax({
                        url: '../nan/php/etudiants.php?info_modal_arch_et='+id_etudiant,
                        type: 'post',
                        processData: false,
                        contentType: false,
                        dataType:'json',
                        success: function(param){
                                $("#titre_modal_arch").html(param.nom_etudiant+' ?');
                                $("#btn_restaurer_et").attr('onclick','restaurer_et('+id_etudiant+')');
                        }
                });
        }
    

    function restaurer_et(id_etudiant){
    if($('#equipe').val()==null){
        ShowMessage("alert",0,"Vous devez choisir une equipe dans la liste")
    }else{
       
            $.ajax({
                    url: '../nan/php/etudiants.php?restaurer_et='+id_etudiant,
                    type: 'post',
                    data: new FormData($(frm_res_et)[0]),
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                            spinner('alert');
                            ShowMessage('alert',param.code,param.message);
                           setTimeout("location.reload()",1500);
                    }
            });
             
    }
}


function like(id,val){
    
            $.ajax({
                    url: '../nan/php/etudiants.php?like='+val+'&id='+id,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                        spinner('alert');
                        ShowMessage('alert',param.code,param.message);
                        location.reload();
                    }
            });
    }


function bonus(id,val){
    
            $.ajax({
                    url: '../nan/php/etudiants.php?bonus='+val+'&id='+id,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                        spinner('alert');
                        ShowMessage('alert',param.code,param.message);
                        location.reload();
                    }
            });
    }
    