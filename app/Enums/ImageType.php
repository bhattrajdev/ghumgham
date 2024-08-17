<?php

namespace App\Enums;

enum ImageType: string
{
    case TYPE_COVER = "cover";
    case TYPE_GALLERY = "gallery";
    case TYPE_FEATURE = "feature";
    case TYPE_DOCS = "doc";
    case TYPE_ICON = "icon";
    case TYPE_META = "meta";
    
}
