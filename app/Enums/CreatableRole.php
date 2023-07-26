<?php

namespace App\Enums;

enum CreatableRole: int
{
    case WRITER = 1;
    case PERFORMER = 2;
    case ARTIST = 3;
    case DIRECTOR = 4;
}
