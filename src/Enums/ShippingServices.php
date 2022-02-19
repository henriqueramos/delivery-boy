<?php

declare(strict_types=1);

namespace HenriqueRamos\DeliveryBoy\Enums;

enum ShippingServices: string
{
    case TRCK = 'TRCK'; // TRACKED
    case SIGN = 'SIGN'; // SIGNATURED
    case UNTR = 'UNTR'; // UNTRACKED
    case PPLEU = 'PPLEU'; // PostNL Parcel EU
    case PPND = "PPND"; // PostNL Parcel Benelux - No sign
    case PPNDS = "PPNDS"; // PostNL Parcel Benelux - Sign
    case PPHD = "PPHD"; // PostNL Parcel Benelux - No sign, no neighbor
    case PPHDS = "PPHDS"; // PostNL Parcel Benelux - Sign, no neighbor
    case PPLGE = "PPLGE"; // PostNL Parcel GlobalPack EMS
    case PPLGU = "PPLGU"; // PostNL Parcel GlobalPack UPU
    case PPTT = "PPTT"; // PostNL Packet Tracked
    case PPTR = "PPTR"; // PostNL Packet Registered
    case PPNT = "PPNT"; // PostNL Packet Non Tracked
    case PPBT = "PPBT"; // PostNL Packet Bag & Trace
    case RM24 = "RM24"; // Royal Mail Tracked 24 - No sign
    case RM24S = "RM24S"; // Royal Mail Tracked 24 - Sign
    case RM48 = "RM48"; // Royal Mail Tracked 48 - No sign
    case RM48S = "RM48S"; // Royal Mail Tracked 48 - Sign
    case SEND = "SEND"; // Sending Mainland
    case SEND2 = "SEND2"; // Sending Islands
    case ITCR = "ITCR"; // Italian Post Crono
    case DPDDE = "DPDDE"; // DPD DE
    case HEHDS = "HEHDS"; // Hermes - Sign
    case CPHD = "CPHD"; // Colis Prive - No sign
    case CPHDS = "CPHDS"; // Colis Prive - Sign
    case SCST = "SCST"; // Spring Com Standard - No sign
    case SCSTS = "SCSTS"; // Spring Com Standard - Sign
    case SCEX = "SCEX"; // Spring Com Express - No sign
    case SCEXS = "SCEXS"; // Spring Com Express - Sign
    case PPND = "PPND"; // PostNL Parcel Benelux - No sign
    case PPNDS = "PPNDS"; // PostNL Parcel Benelux - Sign
    case PPHD = "PPHD"; // PostNL Parcel Benelux - No sign, no neighbor
    case PPHDS = "PPHDS"; // PostNL Parcel Benelux - Sign, no neighbor
}
