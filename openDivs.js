var idAntigo;
function show(id){
    console.log(id);
    
    if(idAntigo!=null){
        let elementoAntigo = document.getElementById(idAntigo);
        elementoAntigo.className = "hide";
    }
    let elemento = document.getElementById(id);
    console.log(elemento);
    
    if(elemento.id=="divCalendario"||elemento.id=="divComissao"||elemento.id=="divPresenca")
        elemento.className = "containers";
    else
        elemento.className = "show";
    idAntigo = id;
}