<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Documentazione API - Progetto PHP MySQL</h1>
    <p>Benvenuti alla documentazione delle API del progetto PHP MySQL. Qui troverete informazioni su come interagire con le API per gestire paesi e viaggi.</p>

<div class="endpoint">
    <h2>1. Endpoint: /paesi.php</h2>
    <p><strong>Base URL:</strong> http://localhost/progetti/progetto_phpmysql_robertaciresa/api/paesi.php</p>

    <h3>GET /paesi.php</h3>
    <p><strong>Descrizione:</strong> Ottieni la lista di tutti i paesi.</p>
    <p><strong>Parametri:</strong> Nessuno.</p>
    <h4>Risposta:</h4>
    <pre><code>[
{
    "id": "1",
    "nome": "Italia"
},
...
]</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>200 OK</code>: Richiesta riuscita.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>

    <h3>POST /paesi.php</h3>
    <p><strong>Descrizione:</strong> Aggiungi un nuovo paese.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>nome</code> (stringa): Nome del paese da aggiungere.</li>
        </ul>
    </p>
    <h4>Corpo della Richiesta:</h4>
    <pre><code>{
"nome": "Francia"
}</code></pre>
    <h4>Risposta:</h4>
    <pre><code>{
"message": "Paese creato con successo"
}</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>201 Created</code>: Paese creato con successo.</li>
        <li><code>400 Bad Request</code>: Dati non forniti correttamente.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>

    <h3>PUT /paesi.php?id={id}</h3>
    <p><strong>Descrizione:</strong> Modifica un paese esistente.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>id</code> (intero): ID del paese da modificare.</li>
        </ul>
    </p>
    <h4>Corpo della Richiesta:</h4>
    <pre><code>{
"nome": "Spagna"
}</code></pre>
    <h4>Risposta:</h4>
    <pre><code>{
"message": "Paese aggiornato con successo"
}</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>200 OK</code>: Paese aggiornato con successo.</li>
        <li><code>400 Bad Request</code>: ID o dati non forniti correttamente.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>

    <h3>DELETE /paesi.php?id={id}</h3>
    <p><strong>Descrizione:</strong> Cancella un paese.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>id</code> (intero): ID del paese da cancellare.</li>
        </ul>
    </p>
    <h4>Risposta:</h4>
    <pre><code>{
"message": "Paese cancellato con successo"
}</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>200 OK</code>: Paese cancellato con successo.</li>
        <li><code>400 Bad Request</code>: ID del paese non fornito.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>
</div>

<div class="endpoint">
    <h2>2. Endpoint: /viaggi.php</h2>
    <p><strong>Base URL:</strong> http://localhost/progetti/progetto_phpmysql_robertaciresa/api/viaggi.php</p>

    <h3>GET /viaggi.php</h3>
    <p><strong>Descrizione:</strong> Ottieni la lista di tutti i viaggi, con possibilità di filtrare per posti disponibili e paese.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>posti_disponibili</code> (intero, facoltativo): Numero minimo di posti disponibili.</li>
            <li><code>paese</code> (stringa, facoltativo): Nome del paese per cui filtrare.</li>
        </ul>
    </p>
    <h4>Risposta:</h4>
    <pre><code>[
{
    "id": "1",
    "posti_disponibili": "27",
    "paesi": "Italia,Svizzera"
},
...
]</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>200 OK</code>: Richiesta riuscita.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>

    <h3>POST /viaggi.php</h3>
    <p><strong>Descrizione:</strong> Aggiungi un nuovo viaggio.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>posti_disponibili</code> (intero): Numero di posti disponibili.</li>
            <li><code>paesi</code> (array di interi): ID dei paesi associati.</li>
        </ul>
    </p>
    <h4>Corpo della Richiesta:</h4>
    <pre><code>{
"posti_disponibili": 20,
"paesi": [1, 2]
}</code></pre>
    <h4>Risposta:</h4>
    <pre><code>{
"message": "Viaggio creato con successo"
}</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>201 Created</code>: Viaggio creato con successo.</li>
        <li><code>400 Bad Request</code>: Dati non forniti correttamente.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>

    <h3>PUT /viaggi.php?id={id}</h3>
    <p><strong>Descrizione:</strong> Modifica un viaggio esistente.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>id</code> (intero): ID del viaggio da modificare.</li>
        </ul>
    </p>
    <h4>Corpo della Richiesta:</h4>
    <pre><code>{
"posti_disponibili": 15,
"paesi": [2, 3]
}</code></pre>
    <h4>Risposta:</h4>
    <pre><code>{
"message": "Viaggio aggiornato con successo"
}</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>200 OK</code>: Viaggio aggiornato con successo.</li>
        <li><code>400 Bad Request</code>: ID o dati non forniti correttamente.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>

    <h3>DELETE /viaggi.php?id={id}</h3>
    <p><strong>Descrizione:</strong> Cancella un viaggio.</p>
    <p><strong>Parametri:</strong>
        <ul>
            <li><code>id</code> (intero): ID del viaggio da cancellare.</li>
        </ul>
    </p>
    <h4>Risposta:</h4>
    <pre><code>{
"message": "Viaggio cancellato con successo"
}</code></pre>
    <h4>Codici di Stato HTTP:</h4>
    <ul>
        <li><code>200 OK</code>: Viaggio cancellato con successo.</li>
        <li><code>400 Bad Request</code>: ID del viaggio non fornito.</li>
        <li><code>500 Internal Server Error</code>: Errore del server.</li>
    </ul>
</div>
</body>
</html>
