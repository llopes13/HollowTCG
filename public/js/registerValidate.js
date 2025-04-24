// Atualiza a direção em tempo real
$('#copiarDireccio').change(function() {
    let isChecked = $(this).prop('checked');
    let address = $('#address').val();

    if (isChecked && address) {
        $('#billing_address').val(address);
    }
});

$('#form-register').submit(function (e) {
    e.preventDefault();
    let name = $('#name').val();
    let lastName = $('#lastName').val();
    let birthdate = $('#birthdate').val();
    let phone = $('#phone').val();
    let email = $('#email').val();
    let pass = $('#password').val();
    let confirmPass = $('#password_confirmation').val();
    let privacy = $('#privacyPolicies').prop('checked');
    let cookies = $('#cookies').prop('checked');
    let address = $('#address').val();
    let copyAddress = $('#copiarDireccio').prop('checked');
    let billingAddress = copyAddress ? address : $('#billing_address').val();

    // Atualiza o valor do campo hidden do checkbox
    $('input[name="copiarDireccio"]').val(copyAddress ? '1' : '0');

    // Validação de nomes e apellidos
    let validName = nameValidator(name, "Nombre");
    let validLastName = nameValidator(lastName, "Apellidos");

    if (!validName.valido) {
        alert(validName.msg);
        return;
    }
    if (!validLastName.valido) {
        alert(validLastName.msg);
        return;
    }

    $('#name').val(validName.valor);
    $('#lastName').val(validLastName.valor);

    // Validação idade
    let validBirth = birthdateValidate(birthdate);
    if (!validBirth.valido) {
        alert(validBirth.msg);
        return;
    }

    // Validação telefone
    let validPhone = phoneValidator(phone);
    if (!validPhone.valido) {
        alert(validPhone.msg);
        return;
    }
    $('#phone').val(validPhone.valor);

    // Validação endereços
    let validEnv = addressValidator(address);
    let validFact = addressValidator(billingAddress);

    if (!validEnv.valido) {
        alert(validEnv.msg);
        return;
    }

    if (!validFact.valido) {
        alert("Direcció de facturació no vàlida");
        return;
    }

    // Validação email
    let validEmail = emailValidator(email);
    if (!validEmail.valido) {
        alert(validEmail.msg);
        return;
    }
    $('#email').val(validEmail.valor);

    // Validação senha
    let validPassword = passwordStrengthValidator(pass, confirmPass);
    if (!validPassword.valido) {
        alert(validPassword.msg);
        return;
    }

    // Validação termos
    if (!privacy) {
        alert("Debes aceptar las políticas de privacidad");
        return;
    }

    if (!cookies) {
        alert("Debes aceptar el uso de cookies");
        return;
    }

    // Garante que o billing_address tem valor
    if (copyAddress) {
        $('#billing_address').val(address);
    }

    // Submete o formulário
    this.submit();
});

// Funções auxiliares:

function nameValidator(valor, tipus) {
    let input = valor.trim();
    let parts = input.split(/\s+/);

    if (parts.length < 1 || parts.length > 2) {
        return { valido: false, msg: `${tipus} ha de tener 1 o 2 nombres` };
    }

    for (let i = 0; i < parts.length; i++) {
        if (!/^[a-zA-ZÀ-ÿ]+$/.test(parts[i])) {
            return { valido: false, msg: `${tipus} solo puede contener letras` };
        }
    }

    let capitalitzat = parts.map(p =>
        p.charAt(0).toUpperCase() + p.slice(1).toLowerCase()
    ).join(" ");

    return { valido: true, valor: capitalitzat };
}

function birthdateValidate(dataStr) {
    let today = new Date();
    let birthdate = new Date(dataStr);

    if (isNaN(birthdate)) {
        return { valido: false, msg: "Fecha de nascimiento no valida" };
    }

    let age = today.getFullYear() - birthdate.getFullYear();
    let mes = today.getMonth() - birthdate.getMonth();
    if (mes < 0 || (mes === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }

    if (age < 18 || age > 100) {
        return { valido: false, msg: "Has de tener entre 18 i 100 años" };
    }

    return { valido: true };
}

function phoneValidator(telefon) {
    let phone = telefon.replace(/\s+/g, "");

    if (!/^\+\d{10,15}$/.test(phone)) {
        return { valido: false, msg: "Introdueix un número de telèfon vàlid amb codi internacional (ex: +34...)" };
    }

    return { valido: true, valor: phone };
}

function addressValidator(direccion) {
    let pattern = /^([\wÀ-ÿ\s]+),\s*(\d+\w?),\s*(\d{5}),\s*([\wÀ-ÿ\s]+)$/;
    let match = direccion.trim().match(pattern);

    if (!match) {
        return { valido: false, msg: "Format incorrecte. Exemple: 'Carrer Major, 123, 08001, Barcelona'" };
    }

    return { valido: true, valor: direccion.trim() };
}

function emailValidator(email) {
    let emailLimpio = email.trim();
    let regex = /^[^\s@]+@gmail\.com$/i;

    if (!regex.test(emailLimpio)) {
        return {
            valido: false,
            msg: "Només s'accepten correus electrònics de Gmail. Exemple: usuari@gmail.com"
        };
    }

    return { valido: true, valor: emailLimpio };
}

function passwordStrengthValidator(pass, confirmPass) {
    if (pass !== confirmPass) {
        return { valido: false, msg: "Les contrasenyes no coincideixen" };
    }

    let strength = 0;
    if (pass.length >= 8) strength++;
    if (/[a-z]/.test(pass)) strength++;
    if (/[A-Z]/.test(pass)) strength++;
    if (/[\W_]/.test(pass)) strength++;

    if (pass.length < 8 || !/[a-z]/.test(pass) || !/[A-Z]/.test(pass) || !/[\W_]/.test(pass)) {
        return { valido: false, msg: "La contrasena debe tener minimo 8 caracteres, una mayúscula, una minúscula y un símbolo especial." };
    }

    let nivell = "";
    if (strength <= 1) nivell = "debil";
    else if (strength === 2 || strength === 3) nivell = "mediana";
    else nivell = "fuerte";

    return { valido: true, nivell: nivell };
}

// Medidor de força da senha
$('#password').on('input', function () {
    let val = $(this).val();
    let strength = 0;

    if (val.length >= 8) strength++;
    if (/[a-z]/.test(val)) strength++;
    if (/[A-Z]/.test(val)) strength++;
    if (/[\W_]/.test(val)) strength++;

    let bar = $('#strengthBar');
    let text = $('#strengthText');

    let width = ["w-0", "w-1/4", "w-1/2", "w-3/4", "w-full"];
    let color = ["bg-red-500", "bg-red-500", "bg-yellow-400", "bg-yellow-400", "bg-green-500"];
    let label = ["debil", "debil", "mediana", "mediana", "fuerte"];
    let textColor = ["text-red-500", "text-red-500", "text-yellow-500", "text-yellow-500", "text-green-600"];

    bar.removeClass("w-0 w-1/4 w-1/2 w-3/4 w-full bg-red-500 bg-yellow-400 bg-green-500");
    text.removeClass("text-red-500 text-yellow-500 text-green-600");

    bar.addClass(width[strength] + " " + color[strength]);
    text.addClass(textColor[strength]).text("Fortalesa: " + label[strength]);
});
