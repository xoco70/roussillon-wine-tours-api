<?php

namespace App\Entity;

enum WineSource: int
{
    case TERRES_DE_VIN = 1;
    case FRIEND = 2;
    case SMALL_TALKS = 3;
    case EVENT = 4;
    case SOCIAL_NETWORKS = 5;
    case LOIRE = 6;
    case SEARCH_ENGINE = 7;
    case COMMERCIAL = 8;
    case WEBSITE = 9;
    case HOST = 10;
}