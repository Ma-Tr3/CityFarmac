<?php

function opcionesCatalogo(array $registros, string $campo, array $formulario): string
{
    $html = '<option value="">Seleccioná una opción</option>';
    $seleccionado = (string) ($formulario[$campo . '_id'] ?? '');

    foreach ($registros as $registro) {
        $id = (int) $registro['id'];
        $padre = $registro['padre_id'] ?? null;

        if (in_array($campo, ['categoria', 'padre'], true) && $padre !== null) {
            continue;
        }

        if ($campo === 'subcategoria' && $padre === null) {
            continue;
        }

        if ($campo === 'padre' && $id === (int) ($formulario['id'] ?? 0)) {
            continue;
        }

        $atributos = (string) $id === $seleccionado ? ' selected' : '';

        if ($campo === 'subcategoria') {
            $atributos .= ' data-parent="' . (int) $padre . '"';
        }

        $html .= '<option value="' . $id . '"' . $atributos . '>'
            . escaparDato($registro['nombre']) . '</option>';
    }

    return $html;
}