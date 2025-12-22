<?php

class AnalyticsService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    /* ===============================
       JENIS EVENT PALING DIMINATI
    ================================ */
    public function getEventPalingDiminati()
    {
        $sql = "
            SELECT 
                k.nama_kategori,
                COUNT(t.id_tiket) AS total_peserta
            FROM event e
            JOIN kategori_event k ON e.id_kategori = k.id_kategori
            LEFT JOIN tiket t ON e.id_event = t.id_event
            GROUP BY k.id_kategori
            ORDER BY total_peserta DESC
        ";

        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* ===============================
       EXPORT CSV
    ================================ */
    public function exportCSV()
    {
        $data = $this->getEventPalingDiminati();

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=analitik_event_paling_diminati.csv");

        $output = fopen("php://output", "w");
        fputcsv($output, ["Kategori Event", "Jumlah Peserta"]);

        foreach ($data as $row) {
            fputcsv($output, [
                $row['nama_kategori'],
                $row['total_peserta']
            ]);
        }

        fclose($output);
        exit;
    }
}
