
function on_quiz(){
    if($('#type_compo').val()==1){
        $('#input_nbr_question').show();    
        $('#input_quota').show();    
        $('#input_sujet').hide();  
    }
    else{
        $('#input_nbr_question').hide();    
        $('#input_quota').hide();   
        $('#input_sujet').show();   
    }
}


function add_compo(){
    
    if(($('#nom_compo').val()=='')&&($('#type_compo').val()=='')&&($('#date_compo').val()=='')){
            ShowMessage('alert',0,'Veuillez remplir le champ');
    }
    else{

            $.ajax({
                    url: '../nan/php/composition.php?add_compo',
                    type: 'post',
                    data: new FormData($(frm_compo)[0]),
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(param){
                        spinner('spinner');
                        ShowMessage('alert',param.code,param.message);
                        reinit('frm_compo'); 
                }
        });
    }
}