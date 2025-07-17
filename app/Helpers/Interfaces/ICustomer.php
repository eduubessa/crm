<?php

declare(strict_types=1);

namespace App\Helpers\Interfaces;

interface ICustomer {

    const TYPES = [
        'business' => 'CUSTOMER::TYPE::BUSINESS',
        'personal' => 'CUSTOMER::TYPE::PERSONAL',
    ];
    const GENDERS = [
        'male' => 'M',
        'female' => 'F',
        'other' => 'O',
    ];
}
