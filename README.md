# dfs_search

##Primera version: En esta primera version, la busqueda avanza de forma lineal hasta toparse con un 'muro' de frente, hay que optimizar y de alguna forma empezar a construir un arbol que me indique donde estan las bifurcaciones 

Esta es la primera version de la funcion de exploración, donde se usa recursividad 

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