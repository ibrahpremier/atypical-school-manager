
$(document).ready(function(){

    // bloquer l'action par defaut du boutton form
    $('form').submit(function(event) { 
        event.preventDefault(); 
      });


});
function spinner(param){
    $('#'+param).html('<img src="../images/preloader.gif">');
        $('#'+param).show();
    setTimeout("$('#"+param+"').hide();",1500);
    console.log("spiner executé");
}

function ShowMessage(al,num,msg){
        if(num==1){
            message=`<div class="alert  alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Succes</span> `+msg+`
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>`;
        }
		else {
            message=`<div class="alert  alert-danger alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-danger">Echec</span> `+msg+`
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
            </div>`;
        }
        $('#'+al).html(message);
		setTimeout("$('#"+al+"').show();",1900);
		setTimeout("$('#"+al+"').fadeOut(1500);",10000);
}

function include(fileName){
    document.write("<script type='text/javascript' src='"+fileName+"'></script>" );
  }
  
function reinit(nom){
    document.forms[nom].reset()
    console.log('form reinitialiser');
}

function chart_main_page(){
    
var ctx = document.getElementById("bestStudent");
ctx.height = 150;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Koffi", "Ibrahim", "Lasso", "Hans", "Baoulé", "Freddy", "Arthur", "Franck", "Arnaud"],
        datasets: [
            {
                label: "Total points",
                data: [40, 55, 75, 15, 55, 81, 56, 55, 40], // les donnéés ici sont rangé suivant l'ordre des etudiants ci-dessus
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

var ctx = document.getElementById("bestTeam");
ctx.height = 150;
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        datasets: [{
            data: [
                80,
                20
            ],
            backgroundColor: [
                "green",
                "red"
            ],
            hoverBackgroundColor: [
                "green",
                "red"
            ]

        }],
        labels: [
            "Present",
            "Absents"
        ]
    },
    options: {
        responsive: true
    }
});

}
  



