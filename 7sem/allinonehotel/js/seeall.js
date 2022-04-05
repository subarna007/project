function seeall(url){
  // console.log(url.split("/"))
    if(url.split("/")[0]==".."){
        url+="?other=0";
    }
    else{
        url+="?other=1";
    }
    // console.log(url)
    if(document.cookie.split(";")[0]=="role=user"){
      url+="&user=noadmin";
    }
    else{
      url+="&user=admin"
    }
    console.log(url)
      const xhttp = new XMLHttpRequest();
  xhttp.onload = function() {
   console.log(this.responseText);
    }
  xhttp.open("GET", url+"?1", true);
  xhttp.send();
}