<?php
$page_title = 'Comprobante de venta';
require_once('../../includes/load.php');
require('../../fpdf186/fpdf.php');
$user = current_user();
// Array con los nombres de los meses en español
$meses = array(
    1 => 'enero',
    2 => 'febrero',
    3 => 'marzo',
    4 => 'abril',
    5 => 'mayo',
    6 => 'junio',
    7 => 'julio',
    8 => 'agosto',
    9 => 'septiembre',
    10 => 'octubre',
    11 => 'noviembre',
    12 => 'diciembre'
);

// Obtener día, mes y año
$dia = date('d');
$mes = $meses[(int)date('m')];
$año = date('Y');

$fecha_formateada = "Piura, $dia de $mes del $año";

class PDF extends FPDF
{
    private $customer_name;
    private $address;
    private $customer_doc;
    private $doc_type;
    private $ai;
    private $fecha_formateada;
    // Constructor que acepta el array $data
    function __construct($orientation, $unit, $size, $data, $fecha_formateada)
    {
        parent::__construct($orientation, $unit, $size);
        // Asignar los valores de customer_name y customer_doc a variables de la clase
        $this->customer_name =
            isset($data[0]['customer_name']) ? $data[0]['customer_name'] : 'Genérico';
        $this->address =
            isset($data[0]['address']) ? $data[0]['address'] : 'Piura';
        $this->customer_doc =
            isset($data[0]['customer_doc']) ? $data[0]['customer_doc'] : '99999999';
        $this->doc_type =
            isset($data[0]['doc_type']) ? $data[0]['doc_type'] : 'OTROS';
        $this->ai =
            isset($data[0]['id']) ? conca0($data[0]['id']) : '999999';
        $this->fecha_formateada = $fecha_formateada;
    }
    // Cabecera de página
    function Header()
    {
        global $user;
        // Definir los márgenes y ancho de columnas
        //$this->SetMargins(30, 10, 10);

        // Definir los anchos de las tres columnas
        $col1_width = 60;  // Columna 1: Logo
        $col2_width = 80;  // Columna 2: Información de la empresa
        $col3_width = 40;  // Columna 3: Boleta y RUC

        // Columna 1: Logo
        $this->SetX(55);
        $this->Image('../../libs/images/logo.jpg', 15, 10, 40); // Ajusta la ruta y el tamaño del logo según tus necesidades
        $this->SetXY(20, 35); // Ajusta la posición para el texto debajo del logo
        $this->SetFont('Arial', '', 6);
        $this->Cell(35, 5, mb_convert_encoding('De: Lily Elizabeth Rondoy Aguilar', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
        $this->SetXY(40, 8);
        $this->Cell(18, 32, '', 'R', 0, 'C');

        // Columna 2: Información de la empresa
        $this->SetFont('arial', 'B', 8);
        $this->SetXY($col1_width, 10); // Posiciona después de la columna 1
        $this->MultiCell($col2_width, 3, mb_convert_encoding('VENTA DE TODO TIPO DE AUTOPARTES Y REPUESTOS EN GENERAL', 'ISO-8859-1', 'UTF-8'), 0, 'C');

        $this->SetFont('helvetica', 'I', 7);
        $this->SetXY($col1_width, 15);
        $this->MultiCell($col2_width, 10, mb_convert_encoding('AV. JESUS DE NAZARETH MZA M1 LOTE 13 MZA. M1 LOTE. 13', 'ISO-8859-1', 'UTF-8'), 0, 'C');
        $this->SetXY($col1_width, 20);
        $this->MultiCell($col2_width, 7, mb_convert_encoding('A.H. LA MOLINA II PIURA - PIURA - VEINTISEIS DE OCTUBRE', 'ISO-8859-1', 'UTF-8'), 0, 'C');
        $this->SetXY($col1_width, 25);
        $this->MultiCell($col2_width, 5, mb_convert_encoding('CEL: XXXXXX', 'ISO-8859-1', 'UTF-8'), 0, 'C');
        $this->SetXY($col1_width, 30);
        $this->SetFont('helvetica', 'I', 6);
        $this->MultiCell($col2_width, 5, mb_convert_encoding('e.mail: ventas@lacasaderepuestos.com.pe', 'ISO-8859-1', 'UTF-8'), 0, 'L');
        $this->SetXY($col1_width, 35);
        $this->SetFont('courier', '', 6);
        $this->Cell($col2_width, 5, mb_convert_encoding($this->fecha_formateada, 'ISO-8859-1', 'UTF-8'), 0, 0.2, 'L');

        // Columna 3: RUC y Boleta de Venta
        $this->SetFont('arial', 'B', 10);
        $this->SetXY($col1_width + $col2_width + 10, 10);
        $this->MultiCell($col3_width, 10, mb_convert_encoding('R.U.C 10707619258', 'ISO-8859-1', 'UTF-8'), 'LTR', 'C');
        $this->Ln(10);
        $this->SetFont('arial', 'B', 10);
        $this->SetXY($col1_width + $col2_width + 10, 20);
        $this->MultiCell($col3_width, 10, mb_convert_encoding('BOLETA DE VENTA', 'ISO-8859-1', 'UTF-8'), 'LR', 'C');
        $this->Ln(10);
        $this->SetFont('arial', 'B', 10);
        $this->SetXY($col1_width + $col2_width + 10, 30);
        $this->MultiCell($col3_width, 10, mb_convert_encoding('0001-' . $this->ai, 'ISO-8859-1', 'UTF-8'), 'LBR', 'C');

        $this->Ln(5);
        /*
        $this->Ln(4);
        $this->SetFont('times', '', 8);
        $this->Cell(0, 5, mb_convert_encoding('Boleta de venta electrónica N° B-' . $this->ai, 'ISO-8859-1', 'UTF-8'), 0, 0.2, 'C');
        $this->Cell(0, 5, mb_convert_encoding('Fecha Emisión: ' . date('d/m/Y H:i:s'), 'ISO-8859-1', 'UTF-8'), 0, 0.2, 'C');
        $this->Cell(0, 5, mb_convert_encoding('Cajero: ' . $user['name'], 'ISO-8859-1', 'UTF-8'), 0, 0.2, 'C');
        $this->Ln(5);*/
        $this->SetX(15);
        $this->SetFont('arial', 'I', 6);
        $this->Cell(25, 5, mb_convert_encoding('Señor(es): ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('arial', 'I', 6);
        $this->SetX(30);
        $this->Cell(0, 5, mb_convert_encoding(strtoupper($this->customer_name), 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

        $this->SetX(30);
        $this->Cell(120, 5, '', 'T', 0, 'L');
        $this->Ln(2);
        $this->SetX(15);
        $this->SetFont('arial', 'I', 6);
        $this->Cell(25, 5, mb_convert_encoding('Dirección: ', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('arial', 'I', 6);
        $this->SetX(30);
        $this->Cell(0, 5, mb_convert_encoding($this->address, 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
        $this->SetX(30);
        $this->Cell(120, 5, '', 'T', 0, 'L');
        $this->Ln(5);
    }

    // Pie de página
    function Footer()
    {
        global $user;
        $this->SetY(-10);
        $this->SetFont('times', 'I', 5);
        $this->Cell(0, 1, mb_convert_encoding('www.lacasaderepuestos.com.pe', 'ISO-8859-1', 'UTF-8'), 0, 0.2, 'C');
        $this->Cell(0, 5, mb_convert_encoding('v.' . VERSION . ' - USUARIO: ' . $user['name'], 'ISO-8859-1', 'UTF-8'), 0, 0.2, 'C');
    }

    // Crear tabla de productos
    function ProductTable($header, $data)
    {
        $this->SetFont('arial', 'B', 8);
        // Anchuras de las columnas
        $w = array(20, 110, 20, 30);
        // Encabezados
        $this->SetX(15);
        for ($i = 0; $i < count($header); $i++) {
            if ($i == 3) {
                $border = 1;
            } else {
                $border = 'LTB';
            }
            $this->Cell($w[$i], 7, $header[$i], $border, 0, 'C');
        }
        $this->Ln();
        // Datos
        $this->SetFont('courier', '', 8);
        foreach ($data as $row) {
            $this->SetX(15);
            $this->Cell($w[0], 6, $row['quantity'], 'LB', 0, 'C');
            $this->Cell($w[1], 6, mb_convert_encoding($row['product_name'], 'ISO-8859-1', 'UTF-8'), 'LB', 0, 'L');
            $this->Cell($w[2], 6, number_format($row['price_unit'], 2), 'LB', 0, 'R');
            $this->Cell($w[3], 6, number_format($row['subtotal'], 2), 'LRB', 0, 'R');
            $this->Ln();
        }
    }

    // Totales
    function Totals($totals)
    {
        $this->SetFont('arial', 'B', 6);
        $this->Cell(25, 6, '', 0, 0);
        $this->Cell(10, 6, 'CANCELADO', 0, 0, 'L');
        $this->Cell(100, 6, '', 0, 0, 'R');
        $this->Cell(20, 2.8, '', 'L', 0, 'R');
        $this->Cell(30, 2.8, ' ', 'LR', 0, 'R');
        $this->Ln(3);
        $this->SetFont('arial', '', 6);
        $this->Cell(25, 6, '', 0, 0);
        $this->Cell(10, 6, mb_convert_encoding($this->fecha_formateada, 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->Cell(100, 6, mb_convert_encoding('FIRMA: ......................................', 'ISO-8859-1', 'UTF-8'), 0, 0, 'R');
        $this->SetFont('arial', 'B', 8);
        $this->Cell(20, 6, 'TOTAL  S/', 'LB', 0, 'R');
        $this->SetFont('courier', 'B', 8);
        $this->Cell(30, 6, ' ' . number_format($totals['total'], 2), 'LRB', 0, 'R');
        $this->Ln();
    }
}

if (isset($_SESSION['post_data'])) {
    $post_data = $_SESSION['post_data'];
    $product_ids = $post_data['product_id'];
    $c_id = $post_data['c_id'];
    $quantities = $post_data['quantity'];
    $subtotals = $post_data['subtotal'];

    $data = [];
    $sum = 0;

    $customer = find_by_id('customers', $c_id);
    $doc_type = find_by_id('document_type', $customer['document_type']);

    //obtener el siguiente autoincrement
    $ai = get_next_ai('tickets');
    $ai = conca0($ai - 1);
    for ($i = 0; $i < count($product_ids); $i++) {
        $products = find_by_id('products', $product_ids[$i]);
        $tickets = find_by_id('tickets', $ai);
        $data[] = [
            'product_id' => $product_ids[$i],
            'product_name' => $products['name'],
            'customer_name' => $customer['name'],
            'customer_doc' => $customer['document'],
            'address' => $customer['address'],
            'doc_type' => $doc_type['short_description'],
            'quantity' => $quantities[$i],
            'price_unit' => $subtotals[$i] / $quantities[$i],
            'subtotal' => $subtotals[$i],
            'id' => $tickets['id'],
            'url' => $tickets['url'],
            'registration_date' => $tickets['registration_date']
        ];
        $sum += $subtotals[$i];
    }

    $igv = $sum * 0.18;
    $gravadas = $sum - $igv;
    $totals = [
        'gravadas' => $gravadas,
        'igv' => $igv,
        'total' => $sum
    ];

    $pdf = new PDF('L', 'mm', array(210, 148), $data, $fecha_formateada);
    $pdf->AddPage();

    $header = array('Cant', mb_convert_encoding('Descripción', 'ISO-8859-1', 'UTF-8'), 'P. Unit.', 'Importe');
    $pdf->ProductTable($header, $data);
    $pdf->Totals($totals);

    $fecha_consulta = $data[0]['registration_date'];
    $fecha_objeto = new DateTime($fecha_consulta);
    $fecha = $fecha_objeto->format('dmyHis');
    $nombre_archivo = 'BV' . (isset($data[0]['id']) ? conca0($data[0]['id']) : '999999') . '-' . $fecha . '.pdf';

    $pdf->Output('../../uploads/tickets/' . $nombre_archivo, 'F');
    //$pdf->Output($nombre_archivo, 'I');
    header('Location: ' . '../../uploads/tickets/' . $nombre_archivo);
    unset($_SESSION['post_data']);
} else {
    echo "Ocurrió un error al procesar el archivo.";
}
