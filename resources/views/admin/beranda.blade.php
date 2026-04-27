<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

/* RESET */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background: #f3f5f7;
}

/* LAYOUT */
.container {
    display: flex;
}

/* SIDEBAR */
.sidebar {
    width: 270px;
    height: 100vh;
    background: #e9f3ec;
    padding: 25px;
}

.logo {
    font-size: 24px;
    font-weight: 700;
    color: #2e7d32;
    margin-bottom: 40px;
}

.menu a {
    display: block;
    padding: 16px;
    margin-bottom: 15px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: 600;
    color: #333;
    background: #f1f1f1;
}

.menu a.active {
    background: #4CAF50;
    color: white;
}

/* MAIN */
.main {
    flex: 1;
    padding: 30px;
}

/* CARD */
.cards {
    display: flex;
    gap: 30px;
    margin-bottom: 35px;
}

.card {
    width: 250px;
    height: 260px;
    background: #f8fafc;
    border-radius: 28px;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    box-shadow:
        8px 8px 20px rgba(0,0,0,0.05),
        -8px -8px 20px rgba(255,255,255,0.9);

    transition: 0.3s;
}

.card:hover {
    transform: translateY(-6px);
}

.card img {
    width: 130px;
    margin-bottom: 18px;
}

.card h3 {
    font-size: 17px;
    color: #444;
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
    gap: 25px;
}

.box {
    background: #fff;
    border-radius: 20px;
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
    padding: 12px;
}

td {
    padding: 12px;
    border-bottom: 1px solid #eee;
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

        <!-- CARD -->
        <div class="cards">

            <div class="card">
                <img src="{{ asset('images/icon/pendapatan.png') }}">
                <h3>Total Pendapatan</h3>
                <div class="value">Rp 1.000.000</div>
            </div>

            <div class="card">
                <img src="{{ asset('images/icon/tiket-hari-i-ni.png') }}">
                <h3>Tiket Hari Ini</h3>
                <div class="value">20 Tiket</div>
            </div>

            <div class="card">
                <img src="{{ asset('images/icon/transaksi.png') }}">
                <h3>Transaksi Hari Ini</h3>
                <div class="value">10 Transaksi</div>
            </div>

        </div>

        <!-- GRID -->
        <div class="grid">

            <div class="box">
                <h3>Pendapatan</h3>
                <canvas id="chart"></canvas>
            </div>

            <div class="box">
                <h3>Pilih Tanggal</h3>
                <input type="date" style="width:100%;padding:10px;border-radius:10px;border:1px solid #ccc;">
            </div>

        </div>

        <!-- TABLE -->
        <div class="box" style="margin-top:25px;">
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

            </table>
        </div>

    </div>

</div>

<script>
new Chart(document.getElementById("chart"), {
    type: "line",
    data: {
        labels: ["11", "12", "13", "14", "15", "16", "17"],
        datasets: [{
            data: [10000,20000,30000,40000,50000,50000,100000],
            fill: true,
            tension: 0.4
        }]
    }
});
</script>

</body>
</html>