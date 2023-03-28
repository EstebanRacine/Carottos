
function showDiv(oEvent){
    var sVal = this.value,
        sIdCible = 'Emplacement'+sVal,
        oForm = this.form,
        sClass = "affichageInfosLivYes",
        // Je recupère les select-cible qui sont dans le form
        // je ne parcours pas tout le DOM en faissant document....
        aDivs = oForm.getElementsByClassName("affichageInfosLiv");
    for(var i = 0; i < aDivs.length; i++){
        var oEle = aDivs[i];
        if(oEle.id === sIdCible){
            oEle.classList.add(sClass)
        }else{
            oEle.classList.remove(sClass)
        }
    }
}

//Quand le DOm est dispo
document.addEventListener('DOMContentLoaded',function(){
    var oForm = document.forms['formulaireValidation'];
    oForm['selectLiv'].addEventListener('change',showDiv);
});
