<?php
// Iniciar el buffering de salida
ob_start();

class laberinto {
    private $lab;   # Matriz del laberinto
    private $pos;   # Posición X,Y del sujeto
    private $pasos; # Cantidad de pasos que avanza

    public function iniciar() {
        # Inicializació de los pasos dados
        $this->pasos = 0;
        # Se crea el laberinto
        $this->crear_lab();
        # Se dibuja el laberinto
        $this->dibujar_lab();
        # Se da la posición inicial
        $this->pos = [19, 1];
        # Se llama la función de exploracion basada en DFS
        $this->exploracion();
    }

    /**
     * La función determina los movimientos que debe hacer el algoritmo para llegar a la salida
     */
    private function exploracion() {
        # Evaluar los cuatro movimientos posibles (arriba, abajo, izquierda, derecha)
        $pos_x = $this->pos[0];
        $pos_y = $this->pos[1];
        $movimientos = [
            [$pos_x - 1, $pos_y], // Arriba
            [$pos_x + 1, $pos_y], // Abajo
            [$pos_x, $pos_y - 1], // Izquierda
            [$pos_x, $pos_y + 1]  // Derecha
        ];
        foreach ($movimientos as $mov) {
            $mov_x = $mov[0];
            $mov_y = $mov[1];
            $res = $this->evaluar_posicion_especifica($mov_x, $mov_y);
            if ($res) {
                # Se marca la posición como visitada
                $this->lab[$mov_x][$mov_y] = '▬';
                # Se actualiza la posición del sujeto
                $this->pos = [$mov_x, $mov_y];
                #Se actualiza la cantidad de pasos
                $this->pasos += 1;
                # Se dibuja el laberinto
                $this->dibujar_lab();
                # Se llama a la función de exploración nuevamente
                $this->exploracion();
            } else {
                break;
            }
        
    }
}

public function evaluar_posicion_especifica($x, $y): bool | array {
    $posicion = $this->lab[$x][$y] ?? null;
    if ($posicion) {
        if ($posicion == 'X') {
            echo "\n". "Posición [$x][$y] es un muro.\n <br>";
            return false;
        } elseif ($posicion == ' ') {
            echo "\n". "Posición [$x][$y] es un espacio vacío.\n <br>";
            $espacio = [
                'X' => $x,
                'Y' => $y
            ];
            return true;
        } elseif ($posicion == 'P' || $posicion == '▬') {
            echo "\n". "Posición [$x][$y] es el punto de partida o un punto ya transitado.\n <br>";
            return false;
        } else  {
            echo "\n". "Posición [$x][$y] es la salida.\n <br>";
            return false;
        }

    } else {
        echo "Posición [$x][$y] fuera de límites.\n <br>";
        return false;
    }
}

    /**
     * La función válida el criterio de éxito
     */
    private function criterio_exito() {
        if ($this->lab[$this->pos[0]][$this->pos[1]] == "S") {
            echo "Felicitaciones!! Laberinto solucionado en $this->pasos pasos"; 
            exit();
        }
    }

    /**
     * La función dibuja la matriz diseñada para el laberinto
     */
    private function dibujar_lab() {
        # Limpiar el buffer de salida
        ob_clean();

        # Se aumenta el número de pasos
        $this->pasos++;

        echo "<table border='0.9'>";
        foreach ($this->lab as $row) {
            echo "<tr>";
            foreach ($row as $col) {
                switch ($col) {
                    case 'X':
                        $color = "#000";
                        break;
                    case 'P':
                        $color = "#77dd77";
                        break;
                    case '▬':
                        $color = "#956868";
                        break;
                    case 'S':
                        $color = "#fdfd96";
                        break;
                    case ' ':
                        $color = "#fff";
                        break;

                }
                echo "<td style='width: 20px; text-align: center; background-color: $color;'>$col</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    private function crear_lab() {
        $this->lab = [
            ['X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X'],
            ['X','X','X','X','X','X',' ','X',' ',' ',' ','X','X','X','X','X','X','X',' ','X'],
            ['X',' ',' ',' ','X','X',' ','X','X','X',' ','X',' ',' ',' ',' ','X','X',' ','X'],
            ['X',' ','X',' ','X','X',' ','X',' ',' ',' ',' ',' ','X','X','X','X','X',' ','X'],
            ['X',' ','X',' ','X','X',' ','X',' ','X','X','X','X','X','X','X','X','X',' ','X'],
            ['X',' ','X','X','X','X',' ','X',' ','X','X','X','X',' ',' ',' ',' ',' ',' ','X'],
            ['X',' ',' ',' ',' ',' ',' ','X',' ','X','X',' ',' ',' ','X','X',' ','X','X','X'],
            ['X','X',' ','X','X','X','X','X',' ','X','X','X','X','X','X','X',' ','X','X','X'],
            ['X','X',' ','X','X','X','X','X',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ',' ','X'],
            ['X','X',' ','X','X','X','X','X',' ','X','X','X','X','X','X','X','X','X',' ','X'],
            ['X','X',' ','X',' ',' ',' ',' ',' ','X','X','X','X','X','X','X','X','X',' ','X'],
            ['X','X',' ','X',' ','X','X','X',' ','X',' ',' ',' ',' ',' ',' ',' ',' ',' ','X'],
            ['X','X',' ','X',' ',' ',' ','X',' ','X','X','X','X','X','X','X','X','X','X','X'],
            ['X','X',' ','X','X','X','X','X',' ','X','X',' ',' ',' ',' ',' ',' ',' ','X','X'],
            ['X',' ',' ',' ',' ',' ',' ',' ',' ','X','X',' ','X','X','X',' ','X',' ','X','X'],
            ['X',' ','X','X','X','X',' ','X','X','X','X',' ','X',' ','X',' ','X',' ','X','X'],
            ['X',' ','X','X','X','X',' ','X','X','X','X',' ','X',' ','X',' ','X',' ','X','X'],
            ['X',' ',' ',' ',' ','X',' ','X','X','X','X',' ','X',' ','X',' ','X',' ','X','X'],
            ['X',' ','X','X','X','X',' ',' ',' ',' ',' ',' ','X',' ',' ',' ','X',' ',' ',' '],
            ['X','P','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','X','S']];
    }

    
}

$lab = new laberinto();
$lab->iniciar();

// $lab->evaluar_posicion_especifica(19, 19);