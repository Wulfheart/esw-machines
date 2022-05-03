/*eslint-env browser */


var ampeln = [];
var timeText = [];
var fullText = [];
var eval = [];
var forms = [];
var timezoneOffset;

function init() {

    const date = new Date();
    timezoneOffset = date.getTimezoneOffset();
    console.log(timezoneOffset);

  

    for (let element of document.getElementsByClassName("ampel")) {
        ampeln.push(element);
    }

    for (let element of document.getElementsByClassName("timeText")) {
        timeText.push(element);
    }

    for (let element of document.getElementsByClassName("inhalt")) {
        fullText.push(element);
    }
    
    for (let element of document.getElementsByClassName("form")) {
        forms.push(element);
    }

    for (let j = 0; j < forms.length; j++) {
        forms[j].addEventListener("submit",function () {
            event.preventDefault();
            getFormValues(forms[j].elements,j+1);
        });
    }
    
    
    load();
    
   // dataRecieved();
   // sendData();
}

function getFormValues(elements,id) {
    let time;
    let full;
    let room;
    
  time = elements[0].value * 60;
  if(time > 0){
      full =1;
  }
  console.log(time);
  let date = Math.round(Date.now() / 1000);
  time = date + time;
  console.log(time);
  
  if(full !== 1){
      if(elements[1].checked){
          full = 1;
      } else {
          full = 0;
      }
  }
  
  
    room = "";
  

    var params = 'id=' + id + '&time=' + time + '&full=' + full + '&room=0';

    sendData(params);
}


function load() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("textbox").innerHTML = xmlhttp.responseText;

            dataRecieved()
        }
    };
    xmlhttp.open("GET", "/php/getuser.php", true);
    xmlhttp.send();

}


function ampel(id, color) {
    
    let ampelColor ;
    
    switch (color) {
        case 0: ampelColor = "gruen";
        break;
        case 1: ampelColor = "orange";
        break;
        case 2: ampelColor = "rot";
        break;
        

    }

    ampeln[id].getElementsByClassName("gruen")[0].classList.remove("an");
    ampeln[id].getElementsByClassName("orange")[0].classList.remove("an");
    ampeln[id].getElementsByClassName("rot")[0].classList.remove("an");
    
    console.log(ampeln[id].getElementsByClassName(ampelColor)[0]);
    ampeln[id].getElementsByClassName(ampelColor)[0].classList.add("an");
}

function clacTime(id, value) {

    const dateStr = value;

    const [dateRelated, timeRelated] = dateStr.split(' ');

    const [year, month, day] = dateRelated.split('-');
    const [hours, minutes, seconds] = timeRelated.split(':');

    const date2 = new Date(+year, month - 1, +day, +hours, +minutes, +seconds);

    let date3 = new Date(date2 - timezoneOffset*60000);
    console.log(date2);
    console.log(date3);

// 👇️ Get timestamp
    let timestamp = date3.getTime();


    let timeValue = timestamp - Date.now();
    if (timeValue < 0) {
        timeText[id].innerHTML = "fertig";
        
        return
        
    }
    
    
    let diff = Math.abs(new Date(timestamp) - new Date(Date.now()));
    let minutes2 = Math.floor((diff/1000)/60);
    
    
    
    let output = convertMinsToHrsMins(minutes2);


    timeText[id].innerHTML = output;
    eval[id] = 2;
}


function convertMinsToHrsMins (minutes) {
    var h = Math.floor(minutes / 60);
    var m = minutes % 60;
    h = h < 10 ? '0' + h : h;
    m = m < 10 ? '0' + m : m;
    return h + ':' + m;
}



function dataRecieved() {

    let i = 0;
    for (let element of document.getElementsByClassName("full")) {
        if(element.innerHTML === "0"){
            fullText[i].innerHTML = "leer";
            eval[i] = 0;
        } else {
            fullText[i].innerHTML = "voll";
            eval[i] = 1;
        }
        i++;

    }

     i = 0;
    for (let element of document.getElementsByClassName("time")) {
        clacTime(i, element.innerHTML);
        i++;

    }

    for (let j = 0; j < eval.length; j++) {
        ampel(j,eval[j]);
    }

}

function sendData(params) {

    var http = new XMLHttpRequest();
    var url = "/php/storedata.php";
    http.open('POST', url, true);

//Send the proper header information along with the request
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            alert(http.responseText);
            load();
        }
    };
    http.send(params);
}

init();