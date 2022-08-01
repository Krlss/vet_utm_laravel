<?php

use App\Mail\NewReport;
use App\Models\Image;
use App\Models\Pet;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\GoogleDrive;
use Illuminate\Support\Facades\DB;

function validateUserID($user_id)
{
    try {
        if (strlen($user_id) == 10) {
            validateCI($user_id);
        } elseif (strlen($user_id) == 13) {
            validateRUC($user_id);
        } else {
            throw new Exception('La cedula o RUC es 10 o 13 dígitos.');
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

function genaretePetId($input)
{

    /* FIRST letter of province + secuencial two letter a-z more secuencial number 001-9999*/
    /* MAA-0001 */
    /* MYY-9999 */

    $letter_user = null;
    $region = null;

    $user = isset($input['user_id']) ? User::where('user_id', $input['user_id'])->first() : null;
    if ($user) {
        //de la provincia del usuario saco su letra
        $letter_user = $user->province()->pluck('letter');
        if (count($letter_user)) $region = $letter_user[0];

        //Si la mascota no tiene dueño, entonces el dueño será el digitador actual logeado...
    } elseif (auth()->check()) {
        $user = User::where('user_id', Auth()->id())->first();
        //de la provincia del usuario digitador saco su letra
        $letter_user = $user->province()->pluck('letter');
        if (count($letter_user)) $region = $letter_user[0];

        //Si llega una creación o reporte desde el telefono y se le envia el user id
    } else {
        $region = 'D';
    }

    $letters = getConvination_letters();

    //se obtiene la ultima mascota dependiendo de que región es 
    $last_pet = Pet::where('pet_id', 'like', strtoupper($region) . '%')->orderBy('pet_id', 'DESC')->pluck('pet_id')->first();

    //Si no existe mascota registrada de esa región, será la primera...
    if (!$last_pet) {
        //Región + AA - 0001
        $last_pet = strtoupper($region . $letters[0] . '-' . '0001');
    } else {
        //El id de la mascota lo convierto en un array para obtener los números ['MGF' , '0203']
        $array_petID = explode("-", $last_pet);

        //Posión 1 tiene los números secuenciales de la última mascota
        $num_int = intval($array_petID[1]);
        $new_num = '';

        $newCombination = '';

        //Obtengo la combinación de la ultima mascota, los últimos dos valores ['A', 'FG']    
        $last_convination_letter = substr($array_petID[0], -2);

        //Solo se pueden 4 dígitos, si es último, se genera uno nuevo 0001
        if ($num_int == 9999) {

            for ($i = 0; $i < count($letters); $i++) {
                //Si son iguales se obtiene la siguiente
                if ($letters[$i] == $last_convination_letter) {
                    $newCombination = $letters[$i + 1];
                }
            }
            $last_pet = strtoupper($region . $newCombination . "-" . '0001');
        } else {
            $num_int = $num_int + 1;

            if ($num_int < 10) $new_num = '000' . $num_int;
            elseif ($num_int < 100) $new_num = '00' . $num_int;
            elseif ($num_int < 1000) $new_num = '0' . $num_int;
            else $new_num = '' . $num_int;

            $last_pet = strtoupper($region . $last_convination_letter . "-" . $new_num);
        }
    }

    return $last_pet;
}

function getConvination_letters()
{
    return array("AA", "AB", "AU", "AC", "AX", "AH", "AO", "AE", "AG", "AI", "AL", "AR", "AM", "AV", "AN", "AS", "AP", "AT", "AZ", "AW", "AK", "AQ", "AJ", "AY", "BA", "BB", "BU", "BC", "BX", "BH", "BO", "BE", "BG", "BI", "BL", "BR", "BM", "BV", "BN", "BS", "BP", "BT", "BZ", "BW", "BK", "BQ", "BJ", "BY", "UA", "UB", "UU", "UC", "UX", "UH", "UO", "UE", "UG", "UI", "UL", "UR", "UM", "UV", "UN", "US", "UP", "UT", "UZ", "UW", "UK", "UQ", "UJ", "UY", "CA", "CB", "CU", "CC", "CX", "CH", "CO", "CE", "CG", "CI", "CL", "CR", "CM", "CV", "CN", "CS", "CP", "CT", "CZ", "CW", "CK", "CQ", "CJ", "CY", "XA", "XB", "XU", "XC", "XX", "XH", "XO", "XE", "XG", "XI", "XL", "XR", "XM", "XV", "XN", "XS", "XP", "XT", "XZ", "XW", "XK", "XQ", "XJ", "XY", "HA", "HB", "HU", "HC", "HX", "HH", "HO", "HE", "HG", "HI", "HL", "HR", "HM", "HV", "HN", "HS", "HP", "HT", "HZ", "HW", "HK", "HQ", "HJ", "HY", "OA", "OB", "OU", "OC", "OX", "OH", "OO", "OE", "OG", "OI", "OL", "OR", "OM", "OV", "ON", "OS", "OP", "OT", "OZ", "OW", "OK", "OQ", "OJ", "OY", "EA", "EB", "EU", "EC", "EX", "EH", "EO", "EE", "EG", "EI", "EL", "ER", "EM", "EV", "EN", "ES", "EP", "ET", "EZ", "EW", "EK", "EQ", "EJ", "EY", "GA", "GB", "GU", "GC", "GX", "GH", "GO", "GE", "GG", "GI", "GL", "GR", "GM", "GV", "GN", "GS", "GP", "GT", "GZ", "GW", "GK", "GQ", "GJ", "GY", "IA", "IB", "IU", "IC", "IX", "IH", "IO", "IE", "IG", "II", "IL", "IR", "IM", "IV", "IN", "IS", "IP", "IT", "IZ", "IW", "IK", "IQ", "IJ", "IY", "LA", "LB", "LU", "LC", "LX", "LH", "LO", "LE", "LG", "LI", "LL", "LR", "LM", "LV", "LN", "LS", "LP", "LT", "LZ", "LW", "LK", "LQ", "LJ", "LY", "RA", "RB", "RU", "RC", "RX", "RH", "RO", "RE", "RG", "RI", "RL", "RR", "RM", "RV", "RN", "RS", "RP", "RT", "RZ", "RW", "RK", "RQ", "RJ", "RY", "MA", "MB", "MU", "MC", "MX", "MH", "MO", "ME", "MG", "MI", "ML", "MR", "MM", "MV", "MN", "MS", "MP", "MT", "MZ", "MW", "MK", "MQ", "MJ", "MY", "VA", "VB", "VU", "VC", "VX", "VH", "VO", "VE", "VG", "VI", "VL", "VR", "VM", "VV", "VN", "VS", "VP", "VT", "VZ", "VW", "VK", "VQ", "VJ", "VY", "NA", "NB", "NU", "NC", "NX", "NH", "NO", "NE", "NG", "NI", "NL", "NR", "NM", "NV", "NN", "NS", "NP", "NT", "NZ", "NW", "NK", "NQ", "NJ", "NY", "SA", "SB", "SU", "SC", "SX", "SH", "SO", "SE", "SG", "SI", "SL", "SR", "SM", "SV", "SN", "SS", "SP", "ST", "SZ", "SW", "SK", "SQ", "SJ", "SY", "PA", "PB", "PU", "PC", "PX", "PH", "PO", "PE", "PG", "PI", "PL", "PR", "PM", "PV", "PN", "PS", "PP", "PT", "PZ", "PW", "PK", "PQ", "PJ", "PY", "TA", "TB", "TU", "TC", "TX", "TH", "TO", "TE", "TG", "TI", "TL", "TR", "TM", "TV", "TN", "TS", "TP", "TT", "TZ", "TW", "TK", "TQ", "TJ", "TY", "ZA", "ZB", "ZU", "ZC", "ZX", "ZH", "ZO", "ZE", "ZG", "ZI", "ZL", "ZR", "ZM", "ZV", "ZN", "ZS", "ZP", "ZT", "ZZ", "ZW", "ZK", "ZQ", "ZJ", "ZY", "WA", "WB", "WU", "WC", "WX", "WH", "WO", "WE", "WG", "WI", "WL", "WR", "WM", "WV", "WN", "WS", "WP", "WT", "WZ", "WW", "WK", "WQ", "WJ", "WY", "KA", "KB", "KU", "KC", "KX", "KH", "KO", "KE", "KG", "KI", "KL", "KR", "KM", "KV", "KN", "KS", "KP", "KT", "KZ", "KW", "KK", "KQ", "KJ", "KY", "QA", "QB", "QU", "QC", "QX", "QH", "QO", "QE", "QG", "QI", "QL", "QR", "QM", "QV", "QN", "QS", "QP", "QT", "QZ", "QW", "QK", "QQ", "QJ", "QY", "JA", "JB", "JU", "JC", "JX", "JH", "JO", "JE", "JG", "JI", "JL", "JR", "JM", "JV", "JN", "JS", "JP", "JT", "JZ", "JW", "JK", "JQ", "JJ", "JY", "YA", "YB", "YU", "YC", "YX", "YH", "YO", "YE", "YG", "YI", "YL", "YR", "YM", "YV", "YN", "YS", "YP", "YT", "YZ", "YW", "YK", "YQ", "YJ", "YY");
}

function uploadImage($files, $external_id)
{
    try {

        DB::beginTransaction();

        $google = new GoogleDrive();

        $filesCurrent = [];
        $imagesCurrentDB = Image::where('external_id', $external_id)->get();

        if ($files) {
            if (!is_array($files)) {
                $file_['name'] = $files->getClientOriginalName();
                $file_['ext'] = $files->getClientOriginalExtension();
                array_push($filesCurrent, $file_);
            } else {
                foreach ($files as $file) {
                    $file_['name'] =  $file->getClientOriginalName();
                    $file_['ext'] = $file->getClientOriginalExtension();
                    array_push($filesCurrent, $file_);
                };
            }
        }

        // eliminar imagenes que no se encuentran en la base de datos
        foreach ($imagesCurrentDB as $imageC) {
            //name = id_image de google, en la vista se muestra el nombre de la imagen
            $exist = array_search($imageC->id_image, array_column($filesCurrent, 'name'));
            if (is_numeric($exist)) {
                continue;
            } else {
                $google->deleteFile($imageC->id_image);
                $imageC->delete();
            }
        }

        // subir imagenes que no se encuentran en la base de datos
        foreach ($filesCurrent as $key => $file) {
            if ($file['ext'] <> '' || $file['base64']) {
                $data = $google->uploadFile(!is_array($files) ? $files : $files[$key]);
                $image['id_image'] = $data['id'];
                $image['url'] = $data['url'];
                $image['name'] = $data['name'];
                $image['external_id'] = $external_id;
                Image::create($image);
            }
        }

        DB::commit();
    } catch (\Throwable $th) {
        DB::rollBack();
        throw new Exception($th->getMessage());
    }
}


function sendNotificationEmailToPetLost($pet)
{
    try {
        $users_ = User::where('email_verified_at', '!=', null)
            ->join('pets', 'users.user_id', '=', 'pets.user_id')
            ->where('pets.id_race', $pet->id_race)
            ->orWhere('pets.id_specie', $pet->id_specie)
            ->pluck('email');

        $users = array_unique($users_->all());
        if ($pet->user) {
            $pos = array_search($pet->user->email, $users);
            unset($users[$pos]);
        }

        $data['name'] = $pet->name;
        $data['specie'] = $pet->specie->name;
        $data['race'] = $pet->race->name;
        $data['user_id'] = $pet->user_id;
        $data['sex'] = $pet->sex;
        $data['fur'] = $pet->fur ? $pet->fur->name : null;

        if ($pet->user) {
            $data['user_name'] = $pet->user->name;
            $data['user_lastname'] = $pet->user->last_name1 . ' ' . $pet->user->last_name2;
            $data['user_email'] = $pet->user->email;
            $data['user_phone'] = $pet->user->phone;
            $data['province'] = $pet->user->province ? $pet->user->province->name : null;
            $data['canton'] = $pet->user->canton ? $pet->user->canton->name : null;
            $data['parish'] = $pet->user->parish ? $pet->user->parish->name : null;
        }

        $detail = [
            'title' => 'Clínica veterinaria de la universidad técnica de manabí',
            'body' => 'Hay un nuevo reporte de una mascota perdida.',
            'data' => $data
        ];

        Mail::to($users)->send(new NewReport($detail));
    } catch (\Throwable $th) {
        //throw $th;
    }
}

function generateProfilePhotoPath($string)
{
    return 'https://ui-avatars.com/api/?name=' . $string[0] . '&color=fff&background=FFB509&bold=true&length=1';
}

function shortenNumber($number, $precision = 2)
{
    if ($number < 1000) {
        return $number;
    }

    $suffixes = array('', 'k', 'm', 'b', 't');
    $exponent = floor(log($number) / log(1000));

    return round($number / pow(1000, $exponent), $precision) . $suffixes[$exponent];
}

function getModelName($model)
{
    $modelName = explode('\\', $model);
    return $modelName[count($modelName) - 1];
}

function getLettersAvailable($letterProvince = null)
{
    //arrayletters same key and value
    $arrayletters = array('A' => 'A', 'B' => 'B', 'C' => 'C', 'D' => 'D', 'E' => 'E', 'F' => 'F', 'G' => 'G', 'H' => 'H', 'I' => 'I', 'J' => 'J', 'K' => 'K', 'L' => 'L', 'M' => 'M', 'N' => 'N', 'O' => 'O', 'P' => 'P', 'Q' => 'Q', 'R' => 'R', 'S' => 'S', 'T' => 'T', 'U' => 'U', 'V' => 'V', 'W' => 'W', 'X' => 'X', 'Y' => 'Y', 'Z' => 'Z');
    //recude arrayletters to letters available
    $letters = Province::pluck('letter', 'letter')->toArray();
    $lettersAvailable = array_diff($arrayletters, $letters);

    if ($letterProvince) {
        $letterCurrent = array($letterProvince => $letterProvince);
        $lettersAvailable = array_merge($lettersAvailable, $letterCurrent);
    }

    return $lettersAvailable;
}

//function return good morning or good afternoon or good evening depending on time
function getGoodMorningOrGoodEveningOrGoodAfternoon()
{
    //get hour zone time ECUADOR
    $timezone = new \DateTimeZone('America/Guayaquil');
    $date = new \DateTime('now', $timezone);
    $hourSystem = $date->format('H');
    if ($hourSystem >= 0 && $hourSystem < 12) {
        return __('Good Morning');
    } else if ($hourSystem >= 12 && $hourSystem < 18) {
        return __('Good Afternoon');
    } else {
        return __('Good Evening');
    }
}

function createAccountFromUTM(Request $request, $api = false)
{
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        if (strpos($request->email, "utm.edu.ec")) {
            /* usuario utm */
            try {
                $response = Http::withHeaders([
                    'X-API-KEY' => '3ecbcb4e62a00d2bc58080218a4376f24a8079e1',
                ])->withOptions(["verify" => false])->post('https://app.utm.edu.ec/becas/api/publico/IniciaSesion', [
                    'usuario' => $request->email,
                    'clave' => $request->password,
                ]);
                $output = $response->json();
            } catch (\Throwable $th) {
                return null;
            }
            if ($output["state"] == "success") {

                $usuario_utm = $output["value"];
                $nombres_utm = explode(" ", $usuario_utm["nombres"], 3);
                $PhotoPath = generateProfilePhotoPath($nombres_utm["2"]);

                $id_province = Province::where('name', 'Manabi')
                    ->orWhere('name', 'Manabí')
                    ->orWhere('name', 'manabí')
                    ->orWhere('name', 'manabi')
                    ->orWhere('name', 'MANABI')
                    ->orWhere('name', 'MANABÍ')
                    ->first()
                    ->id;


                $new_user = User::create([
                    'user_id' => $usuario_utm["cedula"],
                    'name' => $nombres_utm["2"],
                    'last_name1' => $nombres_utm["0"],
                    'last_name2' => $nombres_utm["1"],
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'email_verified_at' => date('Y-m-d h:i:s'),
                    'id_province' => $id_province ?? 1,
                    'api_token' => Str::random(25),
                    'profile_photo_path' => $PhotoPath,
                ]);

                throw ValidationException::withMessages([__('Your account dont have access to the system')]);;
            } else {
                return null;
            }
        } else {
            return null;
        }
    } else {
        if ($user && Hash::check($request->password, $user->password)) {
            if (!$user->canLogin()) {
                throw ValidationException::withMessages([__('Your account dont have access to the system')]);
            }
            return $user;
        }
    }
}
