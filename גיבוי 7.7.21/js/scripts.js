function validateForm() {
    console.log ("check1");
    var validity = true;
    var msg = "";
    var x = document.forms["firstForm"]["fullName"].value;
    if (validity==false)
        alert (msg);
    return validity;
};

function hamburger() {
    console.log("clicked");
    document.getElementById("myDropdown").classList.toggle("show");
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
}
function menu(){
    $( "#hum" ).click(function() {
     hamburger();
    });
  }

function createTable(){
    var NamesArr = ["Black Flags", "Black Lives Matter", "Keep the SHABAT"];
    var LocationsArr = ["Tveria Golani Bridge", "USA Miami", "Bnei Brak"];
    var DatesArr = ["30.2.21", "10.10.2010", "15.1.21"];
    var ParticipateArr = ["no", "no", "yes"]; 
    var mytable = "<table class='table table-striped'> <thead> <tr> <th scope='row'>Name</th> <th scope='row'>Location</th><th scope='row'>Date</th><th scope='row'>Participate</th></tr></thead><tbody>";
    for (var i=0; i<NamesArr.length; i++) {
      console.log(ParticipateArr[i]);
        mytable += "<tr>";
        mytable += "<th scope='row'>" + NamesArr[i] + "</th>";
        mytable += "<td>" + LocationsArr[i] + "</td>"; 
        mytable += "<td>" + DatesArr[i] + "</td>";
        if(ParticipateArr[i] == "yes"){
          mytable += "<td><input type='checkbox' name='mycheckox' checked></td>"
        }
        else{
          mytable += "<td><input type='checkbox' name='mycheckox'></td>"
        }
        mytable+="</tr>"; 
    }
    mytable += "</tbody>";
    mytable += "</table>";
    document.getElementById("chart").innerHTML = mytable
}

function createManageTable(){
  /*var NamesArr = ["Black Flags", "Black Lives Matter", "Keep the SHABAT"];
  var LocationsArr = ["Tveria Golani Bridge", "USA Miami", "Bnei Brak"];
  var DatesArr = ["30.2.21", "10.10.2010", "15.1.21"];
  var ParticipateArr = ["no", "no", "yes"];*/
  var mytable = "<table class='table table-striped'> <thead> <tr> <th scope='row'>Name</th> <th scope='row'>Location</th><th scope='row'>Date</th><th scope='row'>Participate</th></tr></thead><tbody>";
  /*for (var i=0; i<NamesArr.length; i++) {
    if(i==0){
      mytable+= "<tr id=first>"    
    }
    else{
      mytable+= "<tr>"    
    }
    console.log(ParticipateArr[i]);
      mytable += "<tr>";
      mytable += "<th scope='row'>" + NamesArr[i] + "</th>";
      mytable += "<td>" + LocationsArr[i] + "</td>"; 
      mytable += "<td>" + DatesArr[i] + "</td>";
      if(ParticipateArr[i] == "yes"){
        mytable += "<td><input type='checkbox' name='mycheckox' checked></td>"
      }
      else{
        mytable += "<td><input type='checkbox' name='mycheckox'></td>"
      }
      mytable+="</tr>"; 
  }*/
  mytable += "</tbody>";
  mytable += "</table>";
  document.getElementById("chart").innerHTML = mytable
}

function protestPage(){
  $( "tr" ).click(function() {
    window.location = "protest_page.html?protestId=1"
  });
}