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

