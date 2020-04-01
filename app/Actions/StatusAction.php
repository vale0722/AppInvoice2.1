<?php

namespace App\Actions;

use MyCLabs\Enum\Enum;

class StatusAction extends Enum
{
    const OK = 'petición procesada';
    const FAILED = 'Ha fallado';
    const APPROVED = 'Aprobado';
    const APPROVED_PARTIAL = 'Aprobado Parcialmente';
    const PARTIAL_EXPIRED = 'Vencimiento parcial';
    const REJECTED = 'Rechazado';
    const PENDING = 'Pendiente';
    const PENDING_VALIDATION = 'Pendiente de Validación';
    const NO_PRODUCTS = 'Sin productos';
    const BDEFAULT = 'Por Defecto';
}
