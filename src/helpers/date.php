<?php

function dateTimeNowEN()
{
    return (new DateTime())->format("Y-m-d");
}

function dateEN2BR(string $date = null)
{
    if (empty($date)) return null;

    return (new DateTime($date))->format("d/m/Y");
}

function hourNow()
{
    return (new DateTime())->format("H:i:s");
}


function getDiffFrom(DateTime $from, string $format)
{
    $diff = $from->diff((new DateTime()));
    if ($diff->y !== 0) {
        if ($diff->y === 1)
            return "{$diff->y} ano";
        else
            return "{$diff->y} anos";
    } else if ($diff->m !== 0) {
        if ($diff->m === 1)
            return "{$diff->m} mês";
        else
            return "{$diff->m} meses";
    } else if ($diff->d !== 0) {
        if ($diff->d === 1)
            return "{$diff->d} dia";
        else
            return "{$diff->d} dias";
    } else if ($diff->h !== 0) {
        if ($diff->h === 1)
            return "{$diff->h} hora";
        else
            return "{$diff->h} horas";
    } else if ($diff->i !== 0) {
        if ($diff->i === 1)
            return "{$diff->i} minuto";
        else
            return "{$diff->i} minutos";
    } else if ($diff->s !== 0) {
        if ($diff->s === 1)
            return "{$diff->s} segundo";
        else
            return "{$diff->s} segundos";
    }
}
