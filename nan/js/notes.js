
function charg_compo(page){
    console.log("charg_compo");
    if(($('#type_compo').val()!='')){
        var id_type=$('#type_compo').val();

            $.ajax({
                url: '../nan/php/notes.php?charg_compo='+id_type,
                type: 'post',
                data: new FormData($(frm_sel_note)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                    res=`<label for="" class="">Composition:</label><br>
                    <select class="form-control" name="compo" id="compo" onchange="`;
                    if(page=='display') res+=`display_notes_datatable()`;
                    else res+=`charger_notes()`;
                    res+=`">
                    <option value="null" disabled selected> ---CHOISIR---</option>`;
                    if(param.length>1){
                        for(i=1; i<param.length; i++){
                            res+='<option value="'+param[i].id+'" class="uppercase">'+param[i].libelle+'</option>';
                        }
                    }
                    res+='</select>';
                    $("#select_compo").html(res);
                    // console.log(res);
                    console.log("charger la liste des compo");
                }
        });
    }
}

function enreg_notes(){
    if($('#compo').val()==null){
        ShowMessage('alert',0,'Vous devez selectionner une evaluation dans la liste')
    }
    else{
        var compo=$('#compo').val();

            $.ajax({
                url: '../nan/php/notes.php?noter_compo='+compo,
                type: 'post',
                data: new FormData($(frm_note)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                    spinner('spinner');
                    ShowMessage('alert',param.code,param.message);
                    charger_notes();
                }
        });
    }
}

function charger_notes(){
    if($('#compo').val()==null){
        ShowMessage('alert',0,'Vous devez selectionner une evaluation dans la liste')
    }
    else{
        spinner('spinner');
        var compo=$('#compo').val(); 
        $('#btn_mod_note').html('<a href="display_notes.php?eq=2&compo='+compo+'" class="btn btn-info" >Afficher les notes</a>');  

        $.ajax({
            url: '../nan/php/notes.php?nom_compo='+compo,
            type: 'post',
            data: new FormData($(frm_m_note)[0]),
            processData: false,
            contentType: false,
            dataType:'json',
            success: function(param){
                    $('#titre_compo').html(param);
            }
        });

            $.ajax({
                url: '../nan/php/notes.php?charger_note='+compo,
                type: 'post',
                data: new FormData($(frm_note)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                    for(i=0; i<param.length; i++){
                        if(param[i].note!=-1){
                            $('#td_note_'+param[i].etu).html(param[i].note+'&nbsp;&nbsp;<a href="" class="btn btn-link" onclick="modal_mod_note('+param[i].id_noter+')"data-toggle="modal" data-target="#modal_modifier_note"><i class="fa fa-edit"></i></a>');
                        }else{
                            $('#td_note_'+param[i].etu).html(`<input type="number" id="note_et_`+param[i].etu+`" name="note_et_`+param[i].etu+`" placeholder="Entrer une note" class="form-control form-control-sm">`);
                        }

                    }
                }
        });
    }
}


function modal_mod_note(id_noter){
    
            $.ajax({
                    url: '../nan/php/notes.php?info_modal_maj_note='+id_noter,
                    type: 'post',
                    processData: false,
                    contentType: false,
                    dataType:'json',
                    success: function(param){
                            $("#txt_mod_note").val(param.note);
                            $("#btn_maj_note").attr('onclick','maj_note('+id_noter+')');
                    }
            });
}
    


function maj_note(id_noter){
        
        if($('#txt_mod_note').val()==''){
                ShowMessage('alert_note',0,'le champ ne peut etre vide')
        }
        else{

                $.ajax({
                url: '../nan/php/notes.php?maj_note='+id_noter,
                type: 'post',
                data: new FormData($(frm_m_note)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner');
                        ShowMessage('alert',param.code,param.message);
                        charger_notes()
                }
            });
        }
}


function display_notes_datatable(){

    spinner('spinner');

    var compo=$('#compo').val();
    var equipe=$('#equipe_txt_hidden').val();
    $('#btn_afficher_note').html('<a href="gestion_notes.php?eq=2&compo='+compo+'" class="btn btn-info" >Modifier les notes</a>');

    $.ajax({
        url: '../nan/php/notes.php?nom_compo='+compo,
        type: 'post',
        data: new FormData($(frm_m_note)[0]),
        processData: false,
        contentType: false,
        dataType:'json',
        success: function(param){
                $('#titre_compo').html(param);
        }
    });

    $('#bootstrap-data-table-notes').DataTable({
            dom: 'lBfrtip',
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
            oLanguage: { "sUrl": "../assets/json/datatable_fr.txt" },
            buttons: [
                'copyHtml5', 'excelHtml5', 'pdfHtml5'
            ],
            sAjaxSource: "../nan/php/notes.php?display_notes_datatable="+compo+"&eq="+equipe,
            destroy: true
    });
    compo_chart();
}



function compo_chart(){
$('#canvas_div').html('<canvas id="div_compo_chart"></canvas>');
    var compo=$('#compo').val();
    var equipe=$('#equipe_txt_hidden').val();

    $.ajax({
        url: "../nan/php/notes.php?display_notes_chart="+compo+"&eq="+equipe,
        type: 'post',
        processData: false,
        contentType: false,
        dataType:'json',
        success: function(param){
            var nom=[];
            var note=[];
        for(i=0; i<param.length; i++){
            nom[i] =param[i].nom;
            note[i] =param[i].note;
        }

                
var ctx = document.getElementById("div_compo_chart");
ctx.height = 130;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: nom,
        // labels: ["Koffi", "Ibrahim", "Lasso", "Hans", "Baoulé", "Freddy", "Arthur", "Franck", "Arnaud"],
        datasets: [
            {
                label: "Notes compo",
                data: note, // les donnéés ici sont rangé suivant l'ordre des etudiants ci-dessus
                // data: [40, 55, 75, 15, 55, 81, 56, 55, 40], // les donnéés ici sont rangé suivant l'ordre des etudiants ci-dessus
                borderColor: "rgba(0, 123, 255, 0.9)", // couleur de bordure
                borderWidth: "0",
                backgroundColor: "rgba(0, 123, 255, 0.5)" // couleur de fond
            }
        ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

        }//success


});//ajax
}
    