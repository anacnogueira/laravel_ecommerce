<?php

namespace App\Enums;

enum ContactTypeContact: string {
    case CLIENT = 'client';
    case PROVIDER = 'provider';
    case PARTNER = 'partner';
}
