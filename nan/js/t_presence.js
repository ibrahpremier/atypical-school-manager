function enreg_presence(id_etudiant){
var aa=$('#presence'+id_etudiant);

    if(aa.is(':checked')){
        $.ajax({
            url: '../nan/php/t_presence.php?enreg_presence='+id_etudiant,
            type: 'post',
            data: new FormData($(frm_presence)[0]),
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(param){
                spinner('alert');
            }
        });
    }
}


function enreg_absence(id_equipe){
        $.ajax({
            url: '../nan/php/t_presence.php?enreg_absence='+id_equipe,
            type: 'post',
            data: new FormData($(frm_presence)[0]),
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(param){
                spinner('spinner');
                ShowMessage('alert',param.code,param.message);
            }
        });
}

function charg_list_date(){
    spinner('spinner');
    var datep=$('#datep').val();
    var equipe=$('#txt_equipe').val()
    console.log(datep);

    $.ajax({
        url: '../nan/php/t_presence.php?datep='+datep+'&eq='+equipe,
        type: 'post',
        processData: false,
        contentType: false,
        dataType:'json',
        success: function(param){
            $('#titre_presence').html('Présence du '+param);
        }
    });

    $('#bootstrap-data-table-presence').DataTable({
        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        oLanguage: { "sUrl": "../assets/json/datatable_fr.txt" },
        sAjaxSource: "../nan/php/t_presence.php?display_presence_datatable="+datep+"&eq=2",
        destroy: true
    });
}

