//
// function showDivPaie(oEvent){
//     var sVal = this.value,
//         sIdCible = 'Paiement'+sVal,
//         oForm = this.form,
//         sClass = "affichageInfosPaiementYes",
//         // Je recupère les select-cible qui sont dans le form
//         // je ne parcours pas tout le DOM en faissant document....
//         aDivs = oForm.getElementsByClassName("affichageInfosPaiement");
//     for(var i = 0; i < aDivs.length; i++){
//         var oEle = aDivs[i];
//         if(oEle.id === sIdCible){
//             oEle.classList.add(sClass)
//         }else{
//             oEle.classList.remove(sClass)
//         }
//     }
// }
//
// //Quand le DOm est dispo
// document.addEventListener('DOMContentLoaded',function(){
//     var oForm = document.forms['formulaireValidation'];
//     oForm['paiement'].addEventListener('change',showDivPaie);
// });

function choixPaiement() {
    if (document.getElementById('paypalRadio').checked) {
        document.getElementById('PaiementPaypal').className='paypalDiv';
    } else {
        document.getElementById('PaiementPaypal').className='affichageInfosPaiement'
    }

    if (document.getElementById('creditCardRadio').checked) {
        document.getElementById('PaiementCredit').className='creditDiv';
    } else {
        document.getElementById('PaiementCredit').className='affichageInfosPaiement'
    }

    if (document.getElementById('carteCadeauRadio').checked) {
        document.getElementById('PaiementCadeau').className='cadeauDiv';
    } else {
        document.getElementById('PaiementCadeau').className='affichageInfosPaiement'
    }

    if (document.getElementById('applePayRadio').checked) {
        document.getElementById('PaiementApplePay').className='applePayDiv';
    } else {
        document.getElementById('PaiementApplePay').className='affichageInfosPaiement'
    }
}