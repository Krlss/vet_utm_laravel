<?php


function validateUserID($user_id)
{
    try {
        if (strlen($user_id) == 10) {
            validateCI($user_id);
        } elseif (strlen($user_id) == 13) {
            validateRUC($user_id);
        }
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
    return true;
}

function initialValidation($user_id)
{
    //only digit
    if (!ctype_digit($user_id)) throw new Exception('Valor ingresado solo puede tener dígitos');
    return true;
}

function CodeProvinceValidator($user_id)
{
    if ($user_id < 0 or $user_id > 24) throw new Exception('Codigo de Provincia (dos primeros dígitos) no deben ser mayor a 24 ni menores a 0');
    return true;
}

function validateCI($user_id)
{
    try {
        initialValidation($user_id);
        CodeProvinceValidator(substr($user_id, 0, 2));
        validateThridDigit($user_id[2], 'CI');
        algoritmoModulo10(substr($user_id, 0, 9), $user_id[9]);
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
    return true;
}

function validateLastThridDigit($user_id)
{
    if ($user_id != 1) {
        throw new Exception('Ultimos 3 dígitos de un RUC natural terminan en 001');
    }
    return true;
}

function validateRUC($user_id)
{
    if ($user_id[2] < 6) {
        try {
            //natural
            initialValidation($user_id);
            CodeProvinceValidator(substr($user_id, 0, 2));
            validateLastThridDigit(substr($user_id, 10, 3));
            validateThridDigit($user_id[2], 'NATURAL_RUC');
            validarCodigoEstablecimiento(substr($user_id, 10, 3));
            algoritmoModulo10(substr($user_id, 0, 9), $user_id[9]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } elseif ($user_id[2] == 6) {
        //publico
        try {
            initialValidation($user_id);
            CodeProvinceValidator(substr($user_id, 0, 2));
            validateThridDigit($user_id[2], 'PUBLIC_RUC');
            validarCodigoEstablecimiento(substr($user_id, 9, 4));
            algoritmoModulo11(substr($user_id, 0, 8), $user_id[8], 'PUBLIC_RUC');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    } elseif ($user_id[2] == 9) {
        //privado
        try {
            initialValidation($user_id, '13');
            CodeProvinceValidator(substr($user_id, 0, 2));
            validateThridDigit($user_id[2], 'PRIVATE_RUC');
            validarCodigoEstablecimiento(substr($user_id, 10, 3));
            algoritmoModulo11(substr($user_id, 0, 9), $user_id[9], 'PRIVATE_RUC');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    return true;
}

function validarCodigoEstablecimiento($numero)
{
    if ($numero < 1) {
        throw new Exception('Código de establecimiento no puede ser 0');
    }

    return true;
}

function validateThridDigit($user_id, $type)
{
    switch ($type) {
        case 'CI':
        case 'NATURAL_RUC':
            if ($user_id < 0 or $user_id > 5) throw new Exception('Tercer dígito debe ser mayor o igual a 0 y menor a 6 para cédulas y RUC de personas natural');
            break;
        case 'PRIVATE_RUC':
            if ($user_id != 9) throw new Exception('Tercer dígito de RUC debe ser igual a 9 para sociedades privadas');
            break;
        case 'PUBLIC_RUC':
            if ($user_id != 6) throw new Exception('Tercer dígito de RUC debe ser igual a 6 para sociedades públicas');
            break;
        default:
            throw new Exception('Tipo de identificación no existe');
            break;
    }
    return true;
}

/**
 * Algoritmo Modulo10 para validar si CI y RUC de persona natural son válidos.
 *
 * Los coeficientes usados para verificar el décimo dígito de la cédula,
 * mediante el algoritmo “Módulo 10” son:  2. 1. 2. 1. 2. 1. 2. 1. 2
 *
 * Paso 1: Multiplicar cada dígito de los digitosIniciales por su respectivo
 * coeficiente.
 *
 *  Ejemplo
 *  digitosIniciales posicion 1  x 2
 *  digitosIniciales posicion 2  x 1
 *  digitosIniciales posicion 3  x 2
 *  digitosIniciales posicion 4  x 1
 *  digitosIniciales posicion 5  x 2
 *  digitosIniciales posicion 6  x 1
 *  digitosIniciales posicion 7  x 2
 *  digitosIniciales posicion 8  x 1
 *  digitosIniciales posicion 9  x 2
 *
 * Paso 2: Sí alguno de los resultados de cada multiplicación es mayor a o igual a 10,
 * se suma entre ambos dígitos de dicho resultado. Ex. 12->1+2->3
 *
 * Paso 3: Se suman los resultados y se obtiene total
 *
 * Paso 4: Divido total para 10, se guarda residuo. Se resta 10 menos el residuo.
 * El valor obtenido debe concordar con el digitoVerificador
 *
 * Nota: Cuando el residuo es cero(0) el dígito verificador debe ser 0.
 *
 * @param  string $digitosIniciales   Nueve primeros dígitos de CI/RUC
 * @param  string $digitoVerificador  Décimo dígito de CI/RUC
 *
 * @return boolean
 *
 * @throws exception Cuando los digitosIniciales no concuerdan contra
 * el código verificador.
 */

function algoritmoModulo10($digitosIniciales, $digitoVerificador)
{
    $arrayCoeficientes = array(2, 1, 2, 1, 2, 1, 2, 1, 2);

    $digitoVerificador = (int)$digitoVerificador;
    $digitosIniciales = str_split($digitosIniciales);

    $total = 0;
    foreach ($digitosIniciales as $key => $value) {

        $valorPosicion = ((int)$value * $arrayCoeficientes[$key]);

        if ($valorPosicion >= 10) {
            $valorPosicion = str_split($valorPosicion);
            $valorPosicion = array_sum($valorPosicion);
            $valorPosicion = (int)$valorPosicion;
        }

        $total = $total + $valorPosicion;
    }

    $residuo =  $total % 10;

    if ($residuo == 0) {
        $resultado = 0;
    } else {
        $resultado = 10 - $residuo;
    }

    if ($resultado != $digitoVerificador) {
        throw new Exception('Dígitos iniciales no validan contra Dígito Idenficador CI/RUC');
    }

    return true;
}

/**
 * Algoritmo Modulo11 para validar RUC de sociedades privadas y públicas
 *
 * El código verificador es el decimo digito para RUC de empresas privadas
 * y el noveno dígito para RUC de empresas públicas
 *
 * Paso 1: Multiplicar cada dígito de los digitosIniciales por su respectivo
 * coeficiente.
 *
 * Para RUC privadas el coeficiente esta definido y se multiplica con las siguientes
 * posiciones del RUC:
 *
 *  Ejemplo
 *  digitosIniciales posicion 1  x 4
 *  digitosIniciales posicion 2  x 3
 *  digitosIniciales posicion 3  x 2
 *  digitosIniciales posicion 4  x 7
 *  digitosIniciales posicion 5  x 6
 *  digitosIniciales posicion 6  x 5
 *  digitosIniciales posicion 7  x 4
 *  digitosIniciales posicion 8  x 3
 *  digitosIniciales posicion 9  x 2
 *
 * Para RUC privadas el coeficiente esta definido y se multiplica con las siguientes
 * posiciones del RUC:
 *
 *  digitosIniciales posicion 1  x 3
 *  digitosIniciales posicion 2  x 2
 *  digitosIniciales posicion 3  x 7
 *  digitosIniciales posicion 4  x 6
 *  digitosIniciales posicion 5  x 5
 *  digitosIniciales posicion 6  x 4
 *  digitosIniciales posicion 7  x 3
 *  digitosIniciales posicion 8  x 2
 *
 * Paso 2: Se suman los resultados y se obtiene total
 *
 * Paso 3: Divido total para 11, se guarda residuo. Se resta 11 menos el residuo.
 * El valor obtenido debe concordar con el digitoVerificador
 *
 * Nota: Cuando el residuo es cero(0) el dígito verificador debe ser 0.
 *
 * @param  string $digitosIniciales   Nueve primeros dígitos de RUC
 * @param  string $digitoVerificador  Décimo dígito de RUC
 * @param  string $tipo Tipo de identificador
 *
 * @return boolean
 *
 * @throws exception Cuando los digitosIniciales no concuerdan contra
 * el código verificador.
 */
function algoritmoModulo11($digitosIniciales, $digitoVerificador, $tipo)
{
    switch ($tipo) {
        case 'PRIVATE_RUC':
            $arrayCoeficientes = array(4, 3, 2, 7, 6, 5, 4, 3, 2);
            break;
        case 'PUBLIC_RUC':
            $arrayCoeficientes = array(3, 2, 7, 6, 5, 4, 3, 2);
            break;
        default:
            throw new Exception('Tipo de Identificación no existe.');
            break;
    }

    $digitoVerificador = (int)$digitoVerificador;
    $digitosIniciales = str_split($digitosIniciales);

    $total = 0;
    foreach ($digitosIniciales as $key => $value) {
        $valorPosicion = ((int)$value * $arrayCoeficientes[$key]);
        $total = $total + $valorPosicion;
    }

    $residuo =  $total % 11;

    if ($residuo == 0) {
        $resultado = 0;
    } else {
        $resultado = 11 - $residuo;
    }

    if ($resultado != $digitoVerificador) {
        throw new Exception('Dígitos iniciales no validan contra Dígito Idenficador');
    }

    return true;
}
