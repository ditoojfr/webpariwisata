<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Nganjuk</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body {
    font-family: 'Poppins', sans-serif;
    background: #f4f6f9;
}

/* LAYOUT */
.container {
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 260px;
    height: 100vh;
    background: #eef7f1;
    padding: 20px;
}

.logo {
    font-size: 22px;
    font-weight: 700;
    color: #2e7d32;
    margin-bottom: 40px;
}

.menu a {
    display: flex;
    align-items: center;
    padding: 15px;
    margin-bottom: 12px;
    border-radius: 15px;
    text-decoration: none;
    color: #333;
    font-weight: 600;
    background: #fff;
}

.menu a.active {
    background: #4CAF50;
    color: white;
}

/* MAIN */
.main {
    flex: 1;
    padding: 25px;
}

/* CARD ATAS */
.cards {
    display: flex;
    gap: 25px;
    margin-bottom: 25px;
}

/* CARD ICON STYLE */
.card {
    width: 230px;
    height: 260px;
    background: #f9fafb;
    border-radius: 30px;

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    box-shadow:
        12px 12px 30px rgba(0,0,0,0.08),
        -12px -12px 30px rgba(255,255,255,0.9);

    transition: 0.3s;
}

.card:hover {
    transform: translateY(-10px);
}

.card img {
    width: 130px;
    margin-bottom: 20px;
}

.card h3 {
    font-size: 18px;
    color: #444;
    text-align: center;
}

.card .value {
    font-size: 16px;
    font-weight: 700;
    color: #2e7d32;
}

/* GRID */
.grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

/* BOX */
.box {
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #a5d6a7;
    padding: 10px;
}

td {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

/* RESPONSIVE */
@media(max-width: 768px){
    .container {
        flex-direction: column;
    }

    .cards {
        flex-direction: column;
        align-items: center;
    }

    .grid {
        grid-template-columns: 1fr;
    }
}

</style>
</head>

<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="logo">Nganjuk Abirupa</div>

        <div class="menu">
            <a href="#" class="active">Beranda</a>
            <a href="#">Edit Wisata</a>
            <a href="#">Profil</a>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <!-- CARD ICON -->
        <div class="cards">

            <div class="card">
                <img src="pendapatan.png" alt="">
                <h3>Total Pendapatan</h3>
                <div class="value">Rp 1.000.000</div>
            </div>

            <div class="card">
                <img src="tiket.png" alt="">
                <h3>Tiket Hari Ini</h3>
                <div class="value">20 Tiket</div>
            </div>

            <div class="card">
                <img src="transaksi.png" alt="">
                <h3>Transaksi Hari Ini</h3>
                <div class="value">10 Transaksi</div>
            </div>

        </div>

        <!-- GRID -->
        <div class="grid">

            <!-- CHART -->
            <div class="box">
                <h3>Pendapatan</h3>
                <canvas id="chart"></canvas>
            </div>

            <!-- DATE -->
            <div class="box">
                <h3>Pilih Tanggal</h3>
                <input type="date" style="padding:10px; width:100%;">
            </div>

        </div>

        <!-- TABLE -->
        <div class="box" style="margin-top:20px;">
            <h3>Tabel Pendapatan Hari Ini</h3>

            <table>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Destinasi</th>
                    <th>Total</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>TRX001</td>
                    <td>Budi</td>
                    <td>Sedudo</td>
                    <td>50000</td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>TRX002</td>
                    <td>Siti</td>
                    <td>Roro Kuning</td>
                    <td>75000</td>
                </tr>

            </table>
        </div>

    </div>

</div>

<script>

/* CHART */
new Chart(document.getElementById("chart"), {
    type: "line",
    data: {
        labels: ["11 Apr", "12 Apr", "13 Apr", "14 Apr", "15 Apr", "16 Apr", "17 Apr"],
        datasets: [{
            label: "Pendapatan",
            data: [10000, 20000, 30000, 40000, 50000, 50000, 100000],
            fill: true,
            tension: 0.4
        }]
    }
});

</script>

</body>
</html>