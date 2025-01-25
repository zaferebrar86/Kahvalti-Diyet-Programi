<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalori Hesabı ve Diyet Önerisi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 80%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
        .result, .diet-plan {
            margin-top: 20px;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <?php
        $adsoyad = $_SESSION['adsoyad'];
        $cinsiyet = $_SESSION['cinsiyet'];
    ?>
    <h1>Yemek Kalori Hesabı ve Diyet Önerisi</h1>
    <p>Aşağıdaki yemek listesinden miktarları seçin ve toplam kaloriyi hesaplayın. Sağlıklı kiloya ulaşmak için diyet önerisi alın.</p>

    <table>
        <thead>
            <tr>
                <th>Yemek</th>
                <th>Miktar (adet / gram)</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Yulaf</td><td><input type="number" id="yulaf" placeholder="100 gram" min="0"></td></tr>
            <tr><td>Süt</td><td><input type="number" id="sut" placeholder="100 ml" min="0"></td></tr>
            <tr><td>Bal</td><td><input type="number" id="bal" placeholder="10 gram" min="0"></td></tr>
            <tr><td>Tarçın</td><td><input type="number" id="tarcin" placeholder="1 gram" min="0"></td></tr>
            <tr><td>Muz</td><td><input type="number" id="muz" placeholder="100 gram" min="0"></td></tr>
            <tr><td>Avokado</td><td><input type="number" id="avokado" placeholder="100 gram" min="0"></td></tr>
            <tr><td>Domates</td><td><input type="number" id="domates" placeholder="100 gram" min="0"></td></tr>
            <tr><td>Haşlanmış Yumurta</td><td><input type="number" id="yumurta" placeholder="1 adet" min="0"></td></tr>
            <tr><td>Tam Buğday Ekmeği</td><td><input type="number" id="ekmek" placeholder="1 dilim (25g)" min="0"></td></tr>
            <tr><td>Beyaz Peynir veya Kaşar Peynir</td><td><input type="number" id="peynir" placeholder="50 gram" min="0"></td></tr>
            <tr><td>Pekmez</td><td><input type="number" id="pekmez" placeholder="10 gram" min="0"></td></tr>
            <tr><td>Zeytin</td><td><input type="number" id="zeytin" placeholder="5 adet" min="0"></td></tr>
            <tr><td>Portakal Suyu</td><td><input type="number" id="portakal_suyu" placeholder="100 ml" min="0"></td></tr>
        </tbody>
    </table>

    <button onclick="calculateCalories()">Toplam Kaloriyi Hesapla</button>

    <div class="result" id="result"></div>
    <div class="diet-plan" id="dietPlan"></div>

    <script>
        // Session kısmından ad soyad ve cinsiyetin javascript değişkenine tanımlanması
        var adsoyad="<?php echo $adsoyad; ?>";
        var cinsiyet="<?php echo $cinsiyet; ?>";

        // Yemek ve kalori bilgileri
        const foodDatabase = {
            yulaf: 389,             // 100 gram için
            sut: 42,                // 100 ml için
            bal: 304,               // 100 gram için
            tarcin: 247,            // 100 gram için
            muz: 89,                // 100 gram için
            avokado: 160,           // 100 gram için
            domates: 18,            // 100 gram için
            yumurta: 68,            // 1 adet için
            ekmek: 265 / 4,         // 1 dilim (25 gram) için
            peynir: 402,            // 100 gram için
            pekmez: 290,            // 100 gram için
            zeytin: 50 / 5,         // 5 adet için
            portakal_suyu: 45       // 100 ml için
        };

        // Kalori hesaplama ve diyet önerisi
        function calculateCalories() {
            // Kullanıcıdan miktar bilgilerini al
            const yulaf = parseFloat(document.getElementById("yulaf").value) || 0;
            const sut = parseFloat(document.getElementById("sut").value) || 0;
            const bal = parseFloat(document.getElementById("bal").value) || 0;
            const tarcin = parseFloat(document.getElementById("tarcin").value) || 0;
            const muz = parseFloat(document.getElementById("muz").value) || 0;
            const avokado = parseFloat(document.getElementById("avokado").value) || 0;
            const domates = parseFloat(document.getElementById("domates").value) || 0;
            const yumurta = parseFloat(document.getElementById("yumurta").value) || 0;
            const ekmek = parseFloat(document.getElementById("ekmek").value) || 0;
            const peynir = parseFloat(document.getElementById("peynir").value) || 0;
            const pekmez = parseFloat(document.getElementById("pekmez").value) || 0;
            const zeytin = parseFloat(document.getElementById("zeytin").value) || 0;
            const portakal_suyu = parseFloat(document.getElementById("portakal_suyu").value) || 0;

            // Toplam kaloriyi hesapla
            const totalCalories =
                (yulaf * foodDatabase.yulaf) / 100 +
                (sut * foodDatabase.sut) / 100 +
                (bal * foodDatabase.bal) / 100 +
                (tarcin * foodDatabase.tarcin) / 100 +
                (muz * foodDatabase.muz) / 100 +
                (avokado * foodDatabase.avokado) / 100 +
                (domates * foodDatabase.domates) / 100 +
                (yumurta * foodDatabase.yumurta) +
                (ekmek * foodDatabase.ekmek) +
                (peynir * foodDatabase.peynir) / 100 +
                (pekmez * foodDatabase.pekmez) / 100 +
                (zeytin * foodDatabase.zeytin) +
                (portakal_suyu * foodDatabase.portakal_suyu) / 100;

            // Sonuç kısmını güncelle
            document.getElementById("result").textContent = 
                `Toplam Kalori: ${totalCalories.toFixed(2)} kcal`;

            // Diyet önerisi oluştur
            createDietPlan(totalCalories);
        }

        // Diyet önerisi
        function createDietPlan(totalCalories) {


            if (cinsiyet === "erkek") {
                var dailyCalorieNeed = 2500;
            } else if (cinsiyet === "kadin") {
                var dailyCalorieNeed = 2000;
            } else {
                console.log("Cinsiyet yoq.");
            }
            //console.log(cinsiyet);
            //console.log(adsoyad);
            console.log("Hesaba alınan kalori miktarı");
            console.log(dailyCalorieNeed)

            let dietPlan = "";


            if (totalCalories < dailyCalorieNeed * 0.8) {
                dietPlan = "Kalori alımınız düşük. Daha fazla besleyici ve sağlıklı yiyecek tüketmelisiniz.";
                let url = "zayif.html";
                setTimeout(() => {
                    window.location.href = url;
                }, 10000);
            } else if (totalCalories > dailyCalorieNeed * 1.2) {
                dietPlan = "Kalori alımınız yüksek. Kilo kontrolü için porsiyonları küçültmeye çalışın.";
                let url = "kilolu.html";
                setTimeout(() => {
                    window.location.href = url;
                }, 10000);


            } else {
                dietPlan = "Kalori alımınız ideal. Sağlıklı beslenmeye devam edin!";
                let url = "normal.html"
                setTimeout(() => {
                    window.location.href = url;
                }, 10000);
            }

            document.getElementById("dietPlan").textContent = `Diyet Önerisi: ${dietPlan}, Adınız ve Soyadınız: ${adsoyad}, Cinsiyetiniz: ${cinsiyet}. 10 saniye içerisinde yönlendirileceksiniz.`;
        }
    </script>
</body>
</html>
