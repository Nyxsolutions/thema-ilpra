# NYX ILPRA Schema Markup

Plugin WordPress indipendente per il markup JSON-LD ILPRA.

## Installazione

1. Caricare e attivare il plugin su `ilpra.com` e `it.ilpra.com`.
2. Aprire `Impostazioni > NYX Schema Markup`.
3. Verificare i dati aziendali precompilati.
4. Impostare la lingua e l'URL della pagina contatti dell'installazione corrente.

Su `ilpra.com`:

- Lingua: `en`
- URL contatti: la pagina inglese Contatti.

Su `it.ilpra.com`:

- Lingua: `it-IT`
- URL contatti: la pagina italiana Contatti.

## Markup generato

- `Organization`: in tutto il sito, con ID canonico `https://ilpra.com/#organization`.
- `Product`: in ogni singola `packaging_machine`. Legge titolo, URL, immagine, descrizione, categoria e tabella tecnica ACF `dati_tecnici`.
- `NewsArticle`: nei post WordPress con categoria `news`. Legge titolo, URL, immagine, date, lingua, categorie e tag.

Il plugin non inventa prezzi, disponibilita, codici prodotto, audience o keyword non presenti nei contenuti.

## Verifica

Dopo la pubblicazione verificare almeno una macchina e una news con il test dei risultati avanzati di Google e il validator Schema.org. Se un altro plugin SEO genera gia gli stessi tipi di schema, disabilitare quella specifica funzione per evitare dati duplicati.
