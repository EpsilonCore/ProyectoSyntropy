    <?php
    require_once __DIR__ . "/../Gestion/geocodificacion.php";
class ContenedorModel
{
    private $capacidadCarga;
    private $estado;
    private $tipo;
    private $calle;
    private $numero;
    private $barrio;
    private $conexion;
    private $latitud;
    private $longitud;
    private $geocodificador;

    public function __construct($bd)
    {
        $this->conexion = $bd;
        $this->geocodificador = new geocodificacion();
    }

    public function getAllContenedores()
    {
        $sql = "SELECT ID_contenedor, tipo, capacidadCarga, estado, calle, numero, barrio, lat, lon FROM contenedor";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);

        $contenedores= [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $contenedores[] = $fila;
        }

        mysqli_stmt_close($stmt);
        return $contenedores;
    }

    public function buscarContenedor($id)
    {
        $sql = "SELECT ID_contenedor, capacidadCarga, tipo, estado, calle, numero, barrio FROM contenedor WHERE idContenedor = ?";
        $stmt = mysqli_prepare($this->conexion, $sql);
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
        $contenedor = mysqli_fetch_assoc($resultado);

        mysqli_stmt_close($stmt);
        return $contenedor;
    }
    public function crearContenedor($cap, $t, $e, $c, $n,$b){
        $ubicacion = $this->geocodificador->geocodificarDireccion($c, $n, $b);
        if($ubicacion === null){
            throw new Exception("No se pudo geocodificar la dirección proporcionada.");
        }
            $sql = "INSERT INTO contenedor (capacidadCarga, tipo, estado, calle, numero, barrio, lat, lon) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt = mysqli_prepare($this->conexion, $sql);
            $this->capacidadCarga = (!empty($cap)) ? $cap : 0;
            $this->tipo = $t;
            $this->estado = (!empty($e)) ? $e : '';
            $this->calle = $c;
            $this->numero = $n;
            $this->barrio = $b;
            $this->latitud = $ubicacion['lat'];
            $this->longitud = $ubicacion['lon'];
            $stmt->bind_param('isssisdd', $this->capacidadCarga, $this->tipo, $this->estado, $this->calle, $this->numero, $this->barrio, $this->latitud, $this->longitud);
            if($stmt->execute()){
                $stmt->close();
                return true;
            }else {
                $stmt->close();
                return false;
            }

        }
        public function eliminarContenedor($id)
        {
            $sql = "DELETE FROM contenedor WHERE ID_contenedor = ?";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "i", $id);
            $resultado = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $resultado;
        }
        public function actualizarContenedor($id, $cap, $t, $e, $c, $n, $b)
        {
            $sql = "UPDATE contenedor SET capacidadCarga = ?, tipo = ?, estado = ?, calle = ?, numero = ?, barrio = ? WHERE ID_contenedor = ?";
            $stmt = mysqli_prepare($this->conexion, $sql);
            mysqli_stmt_bind_param($stmt, "isssisi", $cap, $t, $e, $c, $n, $b, $id);
            $resultado = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            return $resultado;
        }
}
