function getDim() {
    var w = window.innerWidth;
    document.documentElement.clientWidth;
    document.body.clientWidth;

    var h = window.innerHeight;
    document.documentElement.clientHeight;
    document.body.clientHeight;

    var x = document.getElementById("dim");
    x.innerHTML = "Browser inner window width: " + w + ", height: " + h + ".";
}
 
function getScrW(){
    document.getElementById("scrW").innerHTML = 
    "Screen width is " + screen.width;
}
function getScrH(){
    document.getElementById("scrH").innerHTML = 
    "Screen height is " + screen.height;
}

function getScrAW(){
    document.getElementById("scrAW").innerHTML = 
    "Available screen width is " + screen.availWidth;
}

function getScrAH(){
    document.getElementById("scrAH").innerHTML = 
    "Available screen height is " + screen.availHeight;
}

function getScrCD(){
    document.getElementById("scrCD").innerHTML = 
    "Screen color depth is " + screen.colorDepth;
}

function getScrPD(){
    document.getElementById("scrPD").innerHTML = 
    "Screen pixel depth is " + screen.pixelDepth;
}
function getWLocRef(){
    document.getElementById("wLocRef1").innerHTML = 
    "The full URL of this page is:<br>";
    part2();
}
function part2(){
    document.getElementById("wLocRef2").innerHTML = window.location.href;
}

function getWLocH(){
    document.getElementById("wLocH").innerHTML = 
    "Page hostname is: " + window.location.hostname;
}

function getWLocP(){
    document.getElementById("wLocP").innerHTML =
    "Page path is " + window.location.pathname;
}

function getWLocPr(){
    document.getElementById("wLocPr").innerHTML =
    "Page protocol is " + window.location.protocol;
}

function getWLocPo(){
    document.getElementById("wLocPo").innerHTML =
    "Port number is " + window.location.port;
}

function getCookies(){
    document.getElementById("cookies").innerHTML =
    "navigator.cookieEnabled is " + navigator.cookieEnabled;
}

function getNavN(){
    document.getElementById("navN").innerHTML = 
    "navigator.appName is " + navigator.appName;
}

function getCodeN(){
    document.getElementById("codeN").innerHTML = 
    "navigator.appCodeName is " + navigator.appCodeName;
}
function getProdN(){
    document.getElementById("prodN").innerHTML =
    "navigator.product is " + navigator.product;
}
function getVersion(){
    document.getElementById("version").innerHTML = navigator.appVersion;
}
function getUserA(){
    document.getElementById("userA").innerHTML =
    navigator.userAgent;
}
function getPlat(){
    document.getElementById("plat").innerHTML = 
    "navigator.platform is " + navigator.platform;
}
function getLan(){
    document.getElementById("lan").innerHTML =
    "navigator.language is " + navigator.language;
}
function getOnline(){
    document.getElementById("online").innerHTML =
    "navigator.onLine is " + navigator.onLine;
}
function getJava(){
    document.getElementById("java").innerHTML =
    "javaEnabled is " + navigator.javaEnabled();
}

function printToSite(){
    var name = document.getElementById('fileinput').files[0].name;
    var csv = /.csv$/;
    var json = /.json$/;
    var xml = /.xml$/;
    
    if (csv.test(name)){ //if the file is csv
        csvParse();
    }
    if (json.test(name)){ //if the file is json
        jsonParse();
    }
    if (xml.test(name)){ //if the file is xml
        xmlParse();
    }
}

function csvParse() {
    var x = document.getElementById('fileinput').files[0];
    Papa.parse(x,
        {header: false, complete: function(results){
            $('#pre').remove();
            $('#show').show();
            for (i=0; i < results.data.length; i++) {
               $('#print').append('<div class="result">'+
               '<label><input type="checkbox" class="checkbox"><a href="'+results.data[i][1]+'" class="title">'+results.data[i][0]+'</a></label><br>'+
                     '<a href="'+results.data[i][1]+'" class="url">'+results.data[i][1]+'</a>'+
                     '<p class="desc">'+results.data[i][2]+'</p>'+
                '</div><br>');
                
             }
        }
        });
}

function jsonParse() {
      var file = document.getElementById('fileinput').files[0];
      var fr = new FileReader();
      fr.onload = receivedText;
      fr.readAsText(file);

    function receivedText(e) {
      let lines = e.target.result;
      var parsed = JSON.parse(lines); 
      
      $('#pre').remove();
      $('#show').show();
      for(var i = 0; i<=parsed.Result.length-1; i++){		
        $('#print').append('<div class="result">'+
                                '<label><input type="checkbox" class="checkbox"><a href="'+parsed.Result[i].url+'" class="title">'+parsed.Result[i].title+'</a></label><br>'+
                                '<a href="'+parsed.Result[i].url+'" class="url">'+parsed.Result[i].url+'</a>'+
                                '<p class="desc">'+parsed.Result[i].description+'</p>'+
                            '</div><br>');
    };
    
    }
}

function xmlParse(){
    var file = document.getElementById('fileinput').files[0];
    reader = new FileReader();
    reader.onloadend = function(event) {
        var text = event.target.result;
        var parser = new DOMParser(),
        xmlDom = parser.parseFromString(text, "text/xml");
        var results = $(xmlDom).find("results");
        $('#pre').remove();
        $('#show').show();
        $(results).find('result').each(function() {		
            $('#print').append('<div class="result">'+
                                    '<label><input type="checkbox" class="checkbox"><a href="'+$(this).find('url').text()+'" class="title">'+$(this).find('title').text()+'</a></label><br>'+
                                    '<a href="'+$(this).find('url').text()+'" class="url">'+$(this).find('url').text()+'</a>'+
                                    '<p class="desc">'+$(this).find('description').text()+'</p>'+
                                    '</div><br>');
        });
    }
    reader.readAsText(file);  
}

function down(){
    var select = document.getElementById("fileType")
    var choice = select.options[select.selectedIndex].value;
    if(choice == "CSV"){
        expCSV();
    }
    if(choice == "JSON"){
        expJSON();
    }
    if(choice == "XML"){
        expXML();
    }
}

function expCSV(){
    var text = convertCSV();
    var filename = "file.csv";
    text = text.replace(/\n/g, "\r\n");
    var pom = document.createElement('a');
    var bb = new Blob([text], {type: 'text/plain'});
    pom.setAttribute('href', window.URL.createObjectURL(bb));
    pom.setAttribute('download', filename);
    pom.dataset.downloadurl = ['text/plain', pom.download, pom.href].join(':');
    pom.draggable = true; 
    pom.classList.add('dragout');
    pom.click();
    
    function convertCSV(){
       var csv = "";
        $.each($('.result'), function() {
           if($(this).find('input[type="checkbox"]').is(':checked')){
            csv += $(this).find(".title").text()+","+$(this).find(".url").text()+","+$(this).find(".desc").text()+"\n";
           }
      });
      return csv;
    }
}

function expJSON(){
    var text = convertJSON();
    var filename = "file.json";
    text = text.replace(/\n/g, "\r\n");
    var pom = document.createElement('a');
    var bb = new Blob([text], {type: 'text/plain'});
    pom.setAttribute('href', window.URL.createObjectURL(bb));
    pom.setAttribute('download', filename);
    pom.dataset.downloadurl = ['text/plain', pom.download, pom.href].join(':');
    pom.draggable = true; 
    pom.classList.add('dragout');
    pom.click();
    
    function convertJSON(){
        var json = '{\n  "Result" : [\n';
        $.each($('.result'), function() {
            if($(this).find('input[type="checkbox"]').is(':checked')){
            json += '    {"title":"'+$(this).find(".title").text()+'", '+
                   '"url":"'+$(this).find(".url").text()+'", '+ 
                   '"description":"'+$(this).find(".desc").text()+'"},\n';
            }
        });
      var final = json.substring(0,json.length-2);
      final += "\n  ]\n}"; 
      return final;
    }
}

function expXML(){
    var text = convertXML();
    var filename = "file.xml";
    text = text.replace(/\n/g, "\r\n");
    var pom = document.createElement('a');
    var bb = new Blob([text], {type: 'text/plain'});
    pom.setAttribute('href', window.URL.createObjectURL(bb));
    pom.setAttribute('download', filename);
    pom.dataset.downloadurl = ['text/plain', pom.download, pom.href].join(':');
    pom.draggable = true; 
    pom.classList.add('dragout');
    pom.click();
    
    function convertXML(){
        var xml = '<?xml version=:"1.0" encoding="ISO-8859-1"?>\n<results>\n';
        $.each($('.result'), function() {
            if($(this).find('input[type="checkbox"]').is(':checked')){
            xml += "  <result>\n";
            xml += "    <title>"+$(this).find(".title").text()+"</title>\n";
            xml += "    <url>"+$(this).find(".url").text()+"</url>\n";
            xml += "    <description>"+$(this).find(".desc").text()+"</description>\n";
            xml += "  </result>\n";
            }
        });
      xml += "</results>\n";
      return xml;
    }
}

