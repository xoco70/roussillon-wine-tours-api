<?php

namespace App\Entity;

enum Region: int
{
    case ALSACE = 1;
    case CHAMPAGNE = 2;
    case BOURGOGNE = 3;
    case BORDEAUX = 4;
    case SOUTHWEST = 5;
    case LOIRE = 6;
    case RHONE = 7;
    case MIDI = 8;
    case PROVENCE = 9;
    case CORSE = 10;
    case LANGUEDOC = 11;
    case ROUSSILLON = 12;
}