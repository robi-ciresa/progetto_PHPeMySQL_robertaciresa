<h1>Documentazione API - Progetto PHP MySQL</h1>
<h2>Benvenuti alla documentazione delle API del progetto PHP MySQL. Qui troverete informazioni su come interagire con le API per gestire paesi e viaggi.</h2>

<h3>1. Endpoint: /paesi.php</h3>
Base URL: http://localhost/progetti/progetto_phpmysql_robertaciresa/api/paesi.php

<h4>GET /paesi.php</h4>
Descrizione: Ottieni la lista di tutti i paesi.

Parametri: Nessuno.

Risposta:
[
{
    "id": "1",
    "nome": "Italia"
},
...
]
Codici di Stato HTTP:
200 OK: Richiesta riuscita.
500 Internal Server Error: Errore del server.

<h4>POST /paesi.php</h4>
Descrizione: Aggiungi un nuovo paese.

Parametri:

nome (stringa): Nome del paese da aggiungere.
Corpo della Richiesta:
{
"nome": "Francia"
}
Risposta:
{
"message": "Paese creato con successo"
}
Codici di Stato HTTP:
201 Created: Paese creato con successo.
400 Bad Request: Dati non forniti correttamente.
500 Internal Server Error: Errore del server.

<h4>PUT /paesi.php?id={id}</h4>
Descrizione: Modifica un paese esistente.

Parametri:

id (intero): ID del paese da modificare.
Corpo della Richiesta:
{
"nome": "Spagna"
}
Risposta:
{
"message": "Paese aggiornato con successo"
}
Codici di Stato HTTP:
200 OK: Paese aggiornato con successo.
400 Bad Request: ID o dati non forniti correttamente.
500 Internal Server Error: Errore del server.

<h4>DELETE /paesi.php?id={id}</h4>
Descrizione: Cancella un paese.

Parametri:

id (intero): ID del paese da cancellare.
Risposta:
{
"message": "Paese cancellato con successo"
}
Codici di Stato HTTP:
200 OK: Paese cancellato con successo.
400 Bad Request: ID del paese non fornito.
500 Internal Server Error: Errore del server.

<h3>2. Endpoint: /viaggi.php</h3>
Base URL: http://localhost/progetti/progetto_phpmysql_robertaciresa/api/viaggi.php

<h4>GET /viaggi.php</h4>
Descrizione: Ottieni la lista di tutti i viaggi, con possibilità di filtrare per posti disponibili e paese.

Parametri:

posti_disponibili (intero, facoltativo): Numero minimo di posti disponibili.
paese (stringa, facoltativo): Nome del paese per cui filtrare.
Risposta:
[
{
    "id": "1",
    "posti_disponibili": "27",
    "paesi": "Italia,Svizzera"
},
...
]
Codici di Stato HTTP:
200 OK: Richiesta riuscita.
500 Internal Server Error: Errore del server.

<h4>POST /viaggi.php</h4>
Descrizione: Aggiungi un nuovo viaggio.

Parametri:

posti_disponibili (intero): Numero di posti disponibili.
paesi (array di interi): ID dei paesi associati.
Corpo della Richiesta:
{
"posti_disponibili": 20,
"paesi": [1, 2]
}
Risposta:
{
"message": "Viaggio creato con successo"
}
Codici di Stato HTTP:
201 Created: Viaggio creato con successo.
400 Bad Request: Dati non forniti correttamente.
500 Internal Server Error: Errore del server.

<h4>PUT /viaggi.php?id={id}</h4>
Descrizione: Modifica un viaggio esistente.

Parametri:

id (intero): ID del viaggio da modificare.
Corpo della Richiesta:
{
"posti_disponibili": 15,
"paesi": [2, 3]
}
Risposta:
{
"message": "Viaggio aggiornato con successo"
}
Codici di Stato HTTP:
200 OK: Viaggio aggiornato con successo.
400 Bad Request: ID o dati non forniti correttamente.
500 Internal Server Error: Errore del server.

<h4>DELETE /viaggi.php?id={id}</h4>
Descrizione: Cancella un viaggio.

Parametri:

id (intero): ID del viaggio da cancellare.
Risposta:
{
"message": "Viaggio cancellato con successo"
}
Codici di Stato HTTP:
200 OK: Viaggio cancellato con successo.
400 Bad Request: ID del viaggio non fornito.
500 Internal Server Error: Errore del server.
