<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepté',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date ultérieure à :date.',
    'alpha'                => 'Le champ :attribute doit contenir des lettres seulement.',
    'alpha_dash'           => 'Le champ :attribute doit contenir seulement des lettres, des nombres ou des barres obliques.',
    'alpha_num'            => 'Le champ :attribute doit contenir seulement des lettres ou des chiffres.',
    'array'                => 'Le champ :attribute doit être un array.',
    'before'               => 'Le champ :attribute doit être une date antérieure à :date.',
    'between'              => [
        'numeric' => 'La valeur de :attribute doit se situer entre :min et :max.',
        'file'    => 'La taille du fichier :attribute doit être entre :min et :max kilo octets.',
        'string'  => 'Le champ :attribute doit comporter entre :min et :max caractères.',
        'array'   => 'L\'array :attribute doit comporter entre :min et :max éléments.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux',
    'confirmed'            => 'La cnfirmation du champ :attribute ne correspond pas.',
    'date'                 => 'Le champ :attribute n\'est pas une date valide.',
    'date_format'          => 'Le format du champ :attribute ne correspond pas au format :format.',
    'different'            => 'Le champ :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit comporter :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit comporter entre :min et :max chiffres.',
    'dimensions'           => 'Les dimensions de l\'image :attribute sont invalides.',
    'distinct'             => 'L\'array :attribute contient un doublon.',
    'email'                => 'Le champ :attribute doit être une adresse courriel valide.',
    'exists'               => 'Le champs :attribute n\'existe pas.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute est requis.',
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute est invalide.',
    'in_array'             => 'Le champ :attribute ne doit pas être contenu dans :other.',
    'integer'              => 'Le champ :attribute doit être un nombre entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'json'                 => 'Le champ :attribute doit être un JSON valide.',
    'max'                  => [
        'numeric' => 'Le champ :attribute ne doit pas exéder :max.',
        'file'    => 'Le champ :attribute ne doit pas exéder :max kilo octets.',
        'string'  => 'Le champ :attribute ne doit pas exéder than :max caractères.',
        'array'   => 'Le champ :attribute ne doit pas contenir plus de :max éléments.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type :values.',
    'min'                  => [
        'numeric' => 'Le champ :attribute doit être égal ou supérieur à :min.',
        'file'    => 'La taille de :attribute doit être de :min kilo octets au minimum.',
        'string'  => 'Le champ :attribute doit comporter au moins :min caractères.',
        'array'   => 'L\'array :attribute doit compter au moins :min éléments.',
    ],
    'not_in'               => 'Le champs :attribute est invalide.',
    'numeric'              => 'Le champ :attribute doit être un nombre.',
    'present'              => 'Le champ :attribute doit être présent',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est requis.',
    'required_if'          => 'Le champ :attribute est requis quand :other = :value.',
    'required_unless'      => 'Le champ :attribute est requis sauf si :other est dans :values.',
    'required_with'        => 'Le champ :attribute est requis quand :values est présent.',
    'required_with_all'    => 'Le champ :attribute field is required when :values is present.',
    'required_without'     => 'Le champ :attribute field is required when :values is not present.',
    'required_without_all' => 'Le champ :attribute field is required when none of :values are present.',
    'same'                 => 'Le champ :attribute and :other doivent correspondrent.',
    'size'                 => [
        'numeric' => 'La valeur de :attribute doit être de :size.',
        'file'    => 'La taille du fichier :attribute doit être de :size kilobytes.',
        'string'  => 'Le champ :attribute doit compter :size caractères.',
        'array'   => 'L\'array :attribute doit compter :size éléments.',
    ],
    'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone'             => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique'               => 'Le champ :attribute a déjà été pris.',
    'url'                  => 'L\'URL :attribute est invalide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
