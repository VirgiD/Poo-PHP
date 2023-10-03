<?php
class Libro {
    //atributos
    private string $titulo;
    private string $autor;
    private int $numeroPaginas;
    private int $ejemplaresDisponibles;
    //constructor
    public function __construct(string $titulo, string $autor, int $numeroPaginas, int $ejemplaresDisponibles) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->numeroPaginas = $numeroPaginas;
        $this->ejemplaresDisponibles = $ejemplaresDisponibles;
    }
    //geters y seters
    public function getTitulo(): string {
        return $this->titulo;
    }

    public function getAutor(): string {
        return $this->autor;
    }

    public function getNumeroPaginas(): int {
        return $this->numeroPaginas;
    }

    public function getEjemplaresDisponibles(): int {
        return $this->ejemplaresDisponibles;
    }
    public function setEjemplaresDisponibles(int $cantidad): void {
        $this->ejemplaresDisponibles = $cantidad;
    }
    
    //funciones
    public function reducirEjemplaresDisponibles(): void {
        if ($this->ejemplaresDisponibles > 0) {
            $this->ejemplaresDisponibles--;
        }
    }

    public function aumentarEjemplaresDisponibles(): void {
        $this->ejemplaresDisponibles++;
    }
    
}

class Biblioteca {
    //atributo
    private array $libros = [];

    //lleno el array
    public function agregarLibro(Libro $libro): void {
        $this->libros[] = $libro;
    }

    public function prestarLibro(string $titulo): void {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo && $libro->getEjemplaresDisponibles() > 0) {
                //llamo a la funcion reducirEjemplares...
                $libro->reducirEjemplaresDisponibles();
                echo "Se ha prestado el libro '{$titulo}'.<br>";
                return;
            }
        }
        echo "El libro '{$titulo}' no está disponible para préstamo.<br>";
    }
    

    public function devolverLibro(string $titulo): void {
        foreach ($this->libros as $libro) {
            if ($libro->getTitulo() === $titulo) {
                //llamo a la función aumentar..
                $libro->aumentarEjemplaresDisponibles();
                echo "Se ha devuelto el libro '{$titulo}'.<br>";
                return;
            }
        }
        echo "El libro '{$titulo}' no es parte de esta biblioteca.<br>";
    }

    public function listarLibros(): void {
        echo "Lista de libros en la biblioteca:<br>";
        foreach ($this->libros as $libro) {
            echo "Título: {$libro->getTitulo()}<br>";
            echo "Autor: {$libro->getAutor()}<br>";
            echo "Número de páginas: {$libro->getNumeroPaginas()}<br>";
            echo "Ejemplares disponibles: {$libro->getEjemplaresDisponibles()}<br>";
            echo "----------------------------------------<br>";
        }
    }
}

// Creo instancias de la clase Libro
$libro1 = new Libro("El Hobbit", "J.R.R. Tolkien", 300, 5);
$libro2 = new Libro("Cien años de soledad", "Gabriel García Márquez", 400, 3);
$libro3 = new Libro("Harry Potter y la piedra filosofal", "J.K. Rowling", 350, 8);

// Creo una instancia de la clase Biblioteca
$biblioteca = new Biblioteca();

// Agrego libros a la biblioteca
$biblioteca->agregarLibro($libro1);
$biblioteca->agregarLibro($libro2);
$biblioteca->agregarLibro($libro3);

// Realizo préstamos y devoluciones de libros
$biblioteca->prestarLibro("El Hobbit");
$biblioteca->devolverLibro("Cien años de soledad");
$biblioteca->devolverLibro("Harry Potter y la piedra filosofal");

// Muestro la lista de libros en la biblioteca
$biblioteca->listarLibros();
?>