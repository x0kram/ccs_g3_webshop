<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop | Artikelansicht</title>
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
    </style>
</head>
<body>
    <h1>Gruppe 3 - Webshop</h1>
    
    <div class="article-container">
        <img src="https://ccsstorageg3.blob.core.windows.net/webshop-images/halskette.jpg" alt="Artikel: Halskette" class="article-image">
        <div class="article-details">
            <h2>Halskette (silber)</h2>
            <h3>Artikelnummer: 12340</h3>
            <p>Beschreibung: Dies ist eine kurze Beschreibung des Artikels.</p>
            <p id="in-stock-1">Auf Lager:</p>
            <p class="price">Preis: 79,99 €</p>
            <button id="buy-12340" class="buy-button">Kaufen</button>
        </div>
    </div>

    
    <div class="article-container">
        <img src="https://ccsstorageg3.blob.core.windows.net/webshop-images/armband.jpg" alt="Artikel: Armband" class="article-image">
        <div class="article-details">
            <h2>Armband (silber)</h2>
            <h3>Artikelnummer: 56780</h3>
            <p>Beschreibung: Hier steht eine andere Beschreibung des zweiten Artikels.</p>
            <p id="in-stock-2">Auf Lager:</p>
            <p class="price">Preis: 49,99 €</p>
            <button id="buy-56780" class="buy-button">Kaufen</button>
        </div>
    </div>
</body>
</html>


<script>
    window.onload = function() {
        checkStock();
    }

    // Lagerstandabfrage
    function checkStock() {
        console.log("checkStock()");

        fetch("XXX", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if(!response.ok) {
                console.log("Lagerstand konnte nicht abgefragt werden.")
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            // TODO: Lagerstand in Artikelansicht ergänzen
        })
    }


    // Halskette (ArtNr. 12340) kaufen
    document.getElementById("buy-12340").addEventListener("click", () => {
        console.log("buy-12340");

        // Bestellung verbuchen
        fetch("XXX", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if(!response.ok) {
                console.log("Bestellung (ArtNr. 12340) konnte nicht verbucht werden.")
            }
        })
        
        // Lagerstand aktualisieren
        checkStock();
    })

    
    // Armband (ArtNr. 56780) kaufen
    document.getElementById("buy-56780").addEventListener("click", () => {
        console.log("buy-56780");

        // Bestellung verbuchen
        fetch("XXX", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => {
            if(!response.ok) {
                console.log("Bestellung (ArtNr. 56780) konnte nicht verbucht werden.")
            }
        })

        // Lagerstand aktualisieren
        checkStock();
    })

</script>