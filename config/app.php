<?php

$envVal = env('WAREHOUSE_CODE');

return [
    'warehouseCode' => $envVal ? explode(',', $envVal) : []
];
