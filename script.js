/**
 * Description: Back-end Form. 
 * checkFields -->  Detecta si algun campo del registro es nulo 
 * checkMail --> Detecta si el email tiene el formato correcto
 * checkPassword --> Comprueba si la contraseña tiene la longitud requerida
 * Validacion --> Comprobacion completa
 */

const checkFields = (name, lastName, secondLastName, mail, login, password) => {
    if (name === '' || lastName === '' || secondLastName === '' || mail === '' || login === '' || password === '') {
        return false;
    }
    return true;
}

const checkMail = (mail) => {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; //Expresión regular que comprueba el formato del email
    if (regex.test(mail)) {
        return true;
    }
    return false;
};

const checkPassword = (password) => {
    if (password.length >= 4 && password.length <= 8) {
        return true;
    }

    return false;
};

const validacion = () => {
    const name = document.getElementById('name').value;
    const lastName = document.getElementById('lastName').value;
    const secondLastName = document.getElementById('secondLastName').value;
    const mail = document.getElementById('mail').value;
    const login = document.getElementById('login').value;
    const password = document.getElementById('password').value;
    const isCorrect = checkFields(name, lastName, secondLastName, mail, login, password);

    if (!checkFields) {
        alert('ERROR: Existen campos sin rellenar.');
        return;
    }

    if (!checkMail) {
        alert('El email no es correcto.');
        return;
    }

    if (!checkPassword) {
        alert('La contraseña debe tener entre 4 y 8 caracteres.');
        return;
    }
    
}
