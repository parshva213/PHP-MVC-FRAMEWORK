<?php

namespace core;

class Need
{
    const STASTUS_INACTIVE = 0;
    const STASTUS_ACTIVE = 1;
    const STASTUS_DELETED = 2;

    const ROLE_ADMIN = 'a';
    const ROLE_OWNER = 'o';
    const ROLE_MANUFACTURER = 'm';
    const ROLE_SUPPLIER = 's';
    const ROLE_CUSTOMER = 'c';

    const PRODUCT_STATE_ACTIVE = 'Active';
    const PRODUCT_STATE_INACTIVE = 'In Active';
}
