<?php
    if(isset($_GET['api'])) {
        $ch = curl_init();
        $url = "internal-ac37088aa81164d04bfa43bf88738643-1282929329.eu-west-1.elb.amazonaws.com/inventory";
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        // $response = curl_exec($ch);

        // if(curl_errno($ch)) {
        //     echo "<script>console.log('Error: " . curl_error($ch) . "' );</script>";
        // }
        // else {
        //     echo "<script>console.log('Works: " . $response . "' );</script>";
        // }

        // curl_close($ch);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        // Antwort zurückgeben
        echo json_encode([
            "status" => $httpCode === 200 ? "success" : "error",
            "response" => json_decode($response, true)
        ]);

        echo $response;
    }
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CCS | Gruppe 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .article-container {
            display: flex;
            align-items: flex-start;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .article-image {
            width: 100px; /* Breite fix */
            height: 100px; /* Höhe fix */
            object-fit: cover; /* Bild zuschneiden, damit die Proportionen passen */
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-right: 15px
        }
        .article-details {
            display: flex;
            flex-direction: column;
        }
        .article-details h2, p, .price {
            margin: 5px 0;
        }
        .price {
            font-weight: bold;
            color: #28a745;
        }
        .buy-button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 150px;
            text-align: center;
        }
        .buy-button:hover {
            background-color: #0056b3;
        }
        .storno-button {
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #b4b4b4;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 150px;
            text-align: center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <h1>Artikelübersicht:</h1>
    <form action="" method="GET">
        <button type="submit" name="api">Test API</button>
    </form>
    
    <div class="article-container">
        <img src="https://ccsstorageg3.blob.core.windows.net/webshop-images/halskette.jpg" alt="Artikel: Halskette" class="article-image">
        <div class="article-details">
            <h2>Halskette (silber)</h2> <!-- Bezeichnung -->
            <h3>Artikelnummer: 12340</h3> <!-- Artikelnummer -->
            <p>Beschreibung: Dies ist eine kurze Beschreibung des Artikels.</p> <!-- Beschreibung -->
            <p id="in-stock-1">Auf Lager:</p> <!-- Auf Lager -->
            <p class="price">Preis: 79,99 €</p>
            <button id="buy-12340" class="buy-button">Kaufen</button>
            <button id="storno-12340" class="storno-button">Stornieren</button>
        </div>
    </div>

    
    <div class="article-container">
        <img src="https://ccsstorageg3.blob.core.windows.net/webshop-images/armband.jpg" alt="Artikel: Armband" class="article-image">
        <div class="article-details">
            <h2>Armband (silber)</h2> <!-- Bezeichnung -->
            <h3>Artikelnummer: 56780</h3> <!-- Artikelnummer-->
            <p>Beschreibung: Hier steht eine andere Beschreibung des zweiten Artikels.</p> <!-- Beschreibung -->
            <p id="in-stock-2">Auf Lager:</p> <!-- Auf Lager -->
            <p class="price">Preis: 49,99 €</p>
            <button id="buy-56780" class="buy-button">Kaufen</button>
            <button id="storno-56780" class="storno-button">Stornieren</button>
        </div>
    </div>
</body>
</html>


<script>
    function send2API() {
        $.ajax({
            url: "", // PHP-Datei, hier dieselbe Datei
            type: "GET", // GET-Methode verwenden
            success: function(response) {
                console.log(JSON.stringify(response)); // Antwort anzeigen
            },
            error: function(xhr, status, error) {
                console.log(error); // Error anzeigen
            }
        })
    }


    // Funktionen beim Laden der Website aufrufen:
    window.onload = function() {
        // checkStock(); // Lagerstand aus AWS fetchen
    }

    // Lagerstandabfrage
    function checkStock() {
        console.log("checkStock()");

        fetch("internal-ac37088aa81164d04bfa43bf88738643-1282929329.eu-west-1.elb.amazonaws.com/inventory", {
            method: "GET"
        })
        .then(response => {
            if(!response.ok) {
                console.log("Lagerstand konnte nicht abgefragt werden.")
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            
            // TODO: Lagerstand aus Response anzeigen lassen
        })
    }


    // Halskette (Art-Nr. 12340) kaufen
    document.getElementById("buy-12340").addEventListener("click", () => {
        console.log("buy-12340");

        // Bestellung verbuchen
        /*fetch("XXX", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if(!response.ok) {
                console.log("Bestellung (ArtNr. 12340) konnte nicht verbucht werden.")
            }
        })*/
        
        
        // checkStock(); // Lagerstand aktualisieren
        sendSMS("bestellung", 12340); // Bestellung-SMS versenden
    })

    
    // Armband (Art-Nr. 56780) kaufen
    document.getElementById("buy-56780").addEventListener("click", () => {
        console.log("buy-56780");

        // Bestellung verbuchen
        /*fetch("XXX", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if(!response.ok) {
                console.log("Bestellung (ArtNr. 56780) konnte nicht verbucht werden.")
            }
        })*/

        
        // checkStock(); // Lagerstand aktualisieren
        sendSMS("bestellung", 56780); // Bestellung-SMS versenden
    })


    // Art-Nr. 12340 stornieren
    document.getElementById("storno-12340").addEventListener("click", () => {
        sendSMS("stornierung", 12340); // Storno-SMS versenden
    })

    
    // Art-Nr. 56780 stornieren
    document.getElementById("storno-56780").addEventListener("click", () => {
        sendSMS("stornierung", 56780); // Storno-SMS versenden
    })

    
    // SMS versenden (Type: "bestellung" und "stornierung")
    function sendSMS(type, artikelnummer) {
        const url = "https://prod-123.westeurope.logic.azure.com:443/workflows/b233566567554a4a96e358957447a84e/triggers/When_a_HTTP_request_is_received/paths/invoke?api-version=2016-10-01&sp=%2Ftriggers%2FWhen_a_HTTP_request_is_received%2Frun&sv=1.0&sig=Hat6mIjdqhdTZZHXuPJ7PJZ2bt_cuVHVNukGT68yKOQ";

        const requestData = {
            typ: type,
            artikelnummer: artikelnummer
        };

        fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(requestData)
        })
        .then(response => {
            return response.json()
        })
        .then(response => {
            if (!response.ok) {
                // throw new Error(`HTTP-Fehler! Status: ${response.status}`);
                console.log(response);
            }
            return response.json();
        })
    }
</script>