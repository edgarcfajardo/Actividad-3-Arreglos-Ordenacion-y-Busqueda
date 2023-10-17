<!DOCTYPE html>

<!-- 

#=====================================================
# Equipo:
# *Cruz Fajardo Edgar Alejandro
# *Garcia Lopez Cesar Misael
# *Sanchez Martinez Diego
# *Baez Chavoya Erick
# *Morales Alta Mauro
#=====================================================

-->



<html>
<head>
    <title>Ordenamiento y Búsqueda</title>
</head>
<body>
    <h1>Ordenamiento Y Búsqueda De Un Número</h1>
    <form method="post">
        <label for="lista">Ingrese una lista de números separados por comas (por ejemplo: 1,2,3...):</label>
        <br>
        <input type="text" name="lista" id="lista" required>
        <br>
        <label for="valor_a_buscar">Ingrese el número que desea buscar:</label>
        <br>
        <input type="text" name="valor_a_buscar" id="valor_a_buscar" required>
        <br>
        <br>
        <input type="submit" value="Buscar y Ordenar">
    </form>
</body>
</html>

<?php
// Función para realizar la búsqueda en la lista
function buscar($lista, $valor)
{
    $encontrado = false;
    foreach ($lista as $elemento) {
        if ($elemento == $valor) {
            echo "El valor $valor se encontró en la lista.\n";
            $encontrado = true;
        }
    }
    if (!$encontrado) {
        echo "El valor $valor no se encontró en la lista.\n";
    }
}

//ordenación rápida
function ordenacionRapida($lista)
{
    if (count($lista) < 2) {
        return $lista;
    }

    $menor = $mayor = array();
    reset($lista);
    $pivote_key = key($lista);
    $pivote = array_shift($lista);
    foreach ($lista as $k => $v) {
        if ($v < $pivote)
            $menor[$k] = $v;
        else
            $mayor[$k] = $v;
            
    }

    return array_merge(ordenacionRapida($menor), array($pivote_key => $pivote), ordenacionRapida($mayor));
}

// Ordenación por burbuja
function ordenacionBurbuja($lista)
{
    $n = count($lista);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($lista[$j] > $lista[$j + 1]) {
                $temp = $lista[$j];
                $lista[$j] = $lista[$j + 1];
                $lista[$j + 1] = $temp;
            }
        }
    }
    return $lista;
}

// Ordenación por selección
function ordenacionPorSeleccion($lista)
{
    $n = count($lista);
    for ($i = 0; $i < $n - 1; $i++) {
        $min_index = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($lista[$j] < $lista[$min_index]) {
                $min_index = $j;
            }
        }
        $temp = $lista[$i];
        $lista[$i] = $lista[$min_index];
        $lista[$min_index] = $temp;
    }
    return $lista;
}

// Datos optenidos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lista_str = isset($_POST['lista']) ? $_POST['lista'] : '';
    $valor_a_buscar = isset($_POST['valor_a_buscar']) ? $_POST['valor_a_buscar'] : '';

    // De cadena en una matriz 
    $lista = explode(',', $lista_str);
    $lista = array_map('intval', $lista);

    // Buscar el valor
    buscar($lista, $valor_a_buscar);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mostrar resultados de los tres tipos de ordenamiento
    echo "<br><br>";
    echo "Ordenamiento Rápido: <br>" . implode(", ", ordenacionRapida($lista)) . "<br><br>";
    echo "Ordenamiento por Burbuja: <br>" . implode(", ", ordenacionBurbuja($lista)) . "<br><br>";
    echo "Ordenamiento por Selección: <br>" . implode(", ", ordenacionPorSeleccion($lista)) . "<br><br>";
}

?>
