// global-functions.js
const headerDocument=(titulo = 'DOCUMENTO')=>{
    return `<div class='row align-items-center text-center'>
                <div class='col-12'>
                    <img src='/img/SanTrips.svg' alt='logo' width='120'>

                    <div class='text-sm-center mt-sm-0'>
                    <h5>SANTRIPS</h5>
                    <p class='fs--1 mb-0'>Telefono: 829-123-4567 / Corre: contactos@santrips.com</p>
                    <hr>
                    <p class='fs--1 mb-0 h3'>${titulo}</p>
                    <hr>
                    </div>
                </div>
            </div>`;
}

console.log('hola 2122');

window.headerDocument = headerDocument;
