<?php
class Producto {
    //Atributos
    private string $nombre;
    private string $descripcion;
    private float $precio;
    private int $cantidadInventario;
    //constructor
    public function __construct(string $nombre, string $descripcion, float $precio, int $cantidadInventario) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidadInventario = $cantidadInventario;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getPrecio(): float {
        return $this->precio;
    }

    public function getCantidadInventario(): int {
        return $this->cantidadInventario;
    }
}

class Carrito {
    private array $productos = [];

    public function agregarProducto(Producto $producto, int $cantidad): void {
        $nombreProducto = $producto->getNombre();
        if (isset($this->productos[$nombreProducto])) {
            $this->productos[$nombreProducto]['cantidad'] += $cantidad;
        } else {
            $this->productos[$nombreProducto] = ['producto' => $producto, 'cantidad' => $cantidad];
        }
    }

    public function quitarProducto(Producto $producto): void {
        $nombreProducto = $producto->getNombre();
        if (isset($this->productos[$nombreProducto])) {
            unset($this->productos[$nombreProducto]);
        }
    }

    public function calcularTotal(): float {
        $total = 0.0;
        foreach ($this->productos as $item) {
            $producto = $item['producto'];
            $cantidad = $item['cantidad'];
            $total += $producto->getPrecio() * $cantidad;
        }
        return $total;
    }

    public function mostrarCarrito(): void {
        echo "Contenido del carrito:<br>";
        foreach ($this->productos as $item) {
            $producto = $item['producto'];
            $cantidad = $item['cantidad'];
            echo "Producto: {$producto->getNombre()}<br>";
            echo "Descripción: {$producto->getDescripcion()}<br>";
            echo "Precio unitario: {$producto->getPrecio()} $<br>";
            echo "Cantidad: {$cantidad}<br>";
            echo "Subtotal: " . ($producto->getPrecio() * $cantidad) . " $<br>";
            echo "---------------------------------------<br>";
        }
    }
}

// Creo instancias de la clase Producto para representar varios productos
$producto1 = new Producto("Producto 1", "Descripción del Producto 1", 200.0, 20);
$producto2 = new Producto("Producto 2", "Descripción del Producto 2", 500.0, 15);
$producto3 = new Producto("Producto 3", "Descripción del Producto 3", 300.0, 10);

// Creo una instancia de la clase Carrito
$carrito = new Carrito();

// El cliente agrega productos al carrito
$carrito->agregarProducto($producto1, 2);
$carrito->agregarProducto($producto2, 3);
$carrito->agregarProducto($producto3, 1);

// El cliente quita un producto del carrito
$carrito->quitarProducto($producto1);

// Muestro el contenido del carrito y precio total
$carrito->mostrarCarrito();

// Calculo y muestro el precio total
echo "Precio total del carrito: {$carrito->calcularTotal()} $";
?>