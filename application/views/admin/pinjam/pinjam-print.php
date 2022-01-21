<?php

error_reporting(0);

class FPDF_AutoWrapTable extends FPDF {
  private $data = array();
  private $options = array(
      'filename' => 'Data Peminjaman Alat.pdf',
      'destinationfile' => 'I',
      'paper_size'=>'A4',
      'orientation'=>'P'
  );

  function __construct($data = array(), $options = array()) {
    parent::__construct();
    $this->data = $data;
    $this->options = $options;
}

public function rptDetailData () {
    $border = 0;
    $this->AddPage();
    $this->SetAutoPageBreak(true,60);
    $this->AliasNbPages();
    $left = 25;

        #data dari database
    $con=mysqli_connect("localhost", "root", "", "db_lab");

        //header
    $data = mysqli_query($con,"select * from option");
    while($d = mysqli_fetch_array($data)){
        $dt = mysqli_query($con,"select * from option_laporan");
        while($t = mysqli_fetch_array($dt)){
            $this->Image(base_url() .'assets/img/' . $d['icon'], 65, 25, 60, 60);
            $this->SetFont("", "B", 12);
            $this->SetX($left);
            $this->Cell(0, 15, $t['header1'], 0, 1, 'C');
            $this->SetX($left);
            $this->Cell(0, 15, $t['header2'], 0, 1, 'C');
            $this->SetFont("", "", 9);
            $this->SetX($left);
            if($t['alamat'] != NULL){$d_alamat = $t['alamat'];}else{$d_alamat = $d['alamat'];}
            if($t['telp'] != NULL){$d_telp = $t['telp'];}else{$d_telp = $d['telp'];}
            $this->Cell(0, 15, 'Alamat: ' . $d_alamat . ', Telpon : ' . $d_telp, 0, 1, 'C');
            $this->SetX($left);
            if($t['situs'] != NULL){$d_situs = $t['situs'];}else{$d_situs = base_url();}
            if($t['email'] != NULL){$d_email = $t['email'];}else{$d_email = $d['email'];}
            $this->Cell(0, 15, 'website : ' . $d_situs . ' | email : ' . $d_email, 0, 1, 'C');
            
            $this->SetLineWidth(0);
            $this->Line(29,92,560,92);
            $this->SetLineWidth(1);
            $this->Line(29,93.5,560,93.5);
            
            $this->Ln(10);
            $this->Ln(10);
            $this->SetFont("", "B", 12);
            $this->SetX($left); $this->Cell(0, 20, 'LAPORAN DATA PEMINJAMAN ALAT', 0, 1,'C');
            $this->Ln(10);
        }
    }

    $h = 18;
    $left = 40;
    $top = 80;

        #tableheader
    $this->SetFillColor(200,200,200);    
    $left = $this->GetX();
    $this->SetFont("", "B", 6);
    $this->Cell(23,$h,'NO',1,0,'L',true);
    $this->SetX($left += 23); $this->Cell(45, $h, 'NIM/NIM', 1, 0, 'C',true);
    $this->SetX($left += 45); $this->Cell(75, $h, 'NAMA', 1, 0, 'C',true);
    $this->SetX($left += 75); $this->Cell(100, $h, 'TUJUAN/JUDUL PENELITIAN', 1, 0, 'C',true);
    $this->SetX($left += 100); $this->Cell(50, $h, 'NAMA ALAT', 1, 0, 'C',true);
    $this->SetX($left += 50); $this->Cell(40, $h, 'KONDISI', 1, 0, 'C',true);
    $this->SetX($left += 40); $this->Cell(35, $h, 'JUMLAH', 1, 0, 'C',true);
    $this->SetX($left += 35); $this->Cell(65, $h, 'TANGGAL PINJAM', 1, 0, 'C',true);
    $this->SetX($left += 65); $this->Cell(65, $h, 'TANGGAL KEMBALI', 1, 0, 'C',true);
    $this->SetX($left += 65); $this->Cell(40, $h, 'JAMINAN', 1, 1, 'C',true);
        //$this->Ln(20);

    $this->SetFont('Arial','',6);
    $this->SetWidths(array(23,45,75,100,50,40,35,65,65,40));
    $this->SetAligns(array('C','L','L','L','L'));
    $no = 1; $this->SetFillColor(255);

        #data dari database
    $con=mysqli_connect("localhost", "root", "", "db_lab");

    $filter= $_POST['filter'];
    $waktu= $_POST['waktu'];
    $waktu1= $_POST['waktu1'];
    $waktu2= $_POST['waktu2'];


    if($filter=='Bulanan'){
        $sql = mysqli_query($con, "SELECT * FROM pinjam WHERE tgl_pinjam like '".$waktu."%' ORDER BY  tgl_pinjam DESC");
    }elseif ($filter=='Tahunan') {
        $sql = mysqli_query($con, "SELECT * FROM pinjam WHERE tgl_pinjam like '".$waktu."%' ORDER BY  tgl_pinjam DESC");
    }elseif ($filter=='Semester') {
        $sql = mysqli_query($con, "SELECT * FROM pinjam WHERE tgl_pinjam BETWEEN '".$waktu1."' AND '".$waktu2."' ORDER BY tgl_pinjam DESC");
    }else{
        $sql = mysqli_query($con, "SELECT * FROM pinjam ORDER BY  tgl_pinjam DESC");
    }

    $bln = array(
      '01' => 'Januari',
      '02' => 'Februari',
      '03' => 'Maret',
      '04' => 'April',
      '05' => 'Mei',
      '06' => 'Juni',
      '07' => 'Juli',
      '08' => 'Agustus',
      '09' => 'September',
      '10' => 'Oktober',
      '11' => 'November',
      '12' => 'Desember'
  );

    while($data = mysqli_fetch_array($sql))
    {
        if(!empty($data['tgl_kembali'])){
            $tgl_kembali = date("j ", strtotime($data['tgl_kembali'])).$bln[date("m", strtotime($data['tgl_kembali']))].date(" Y", strtotime($data['tgl_kembali']));
        }else{
            $tgl_kembali = 'Belum Kembali';
        } 
        $this->Row(
            array($no++,
                $data['nim'], 
                $data['nama'], 
                $data['tujuan'], 
                $data['nama_alat'], 
                $data['kondisi'], 
                $data['jumlah_alat'], 
                date("j ", strtotime($data['tgl_pinjam'])).$bln[date("m", strtotime($data['tgl_pinjam']))].date(" Y", strtotime($data['tgl_pinjam'])), 
                $tgl_kembali,
                $data['jaminan']
            )
        );
    }

    $dt = mysqli_query($con,"select * from option_laporan");
    while($t = mysqli_fetch_array($dt)){
        #tabel footer
        $this->Ln(20);
        $this->SetFont("", "", 9);
        $this->SetX(400);
        $this->Cell(0, 15, $t['kota'] . ', ' . date('d') . ' ' . $bln[date('m')] . ' ' . date('Y') . '', 0, 1, 'L');
        $this->SetX(400);
        $this->Cell(0, 15, $t['an'], 0, 1, 'L');
        $this->Ln(25);
        $this->SetX(400);
        $this->Cell(0, 15, $t['nama'], 0, 1, 'L');
        $this->SetX(400);
        $this->Cell(0, 15, 'NIP.' . $t['nip'], 0, 1, 'L');
    }
}

public function printPDF () {
    if ($this->options['paper_size'] == "A4") {
            $a = 8.3 * 72; //1 inch = 72 pt
            $b = 13.0 * 72;
            $this->FPDF($this->options['orientation'], "pt", array($a,$b));
        } else {
            $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
        }

        $this->SetAutoPageBreak(false);
        $this->AliasNbPages();
        $this->SetFont("helvetica", "B", 10);
        //$this->AddPage();

        $this->rptDetailData();
        $this->Output($this->options['filename'],$this->options['destinationfile']);
    }

    private $widths;
    private $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
            $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h=15*$nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();

            //Draw the border
            $this->Rect($x,$y,$w,$h);

            //Print the text
            $this->MultiCell($w,15,$data[$i],0,$a);

            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }

        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;

        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }
} //end of class

//pilihan
$options = array(
    'filename' => 'Data Peminjaman Alat.pdf',
    'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
    'paper_size'=>'A4',    //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>